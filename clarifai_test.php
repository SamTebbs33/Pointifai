<?php

require_once "config.php";

function get_tags_and_probs($img_url){
	
	$curl = curl_init();
	echo "token: " . $key_clarifai_token . "<br>";
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.clarifai.com/v1/tag/",
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_POSTFIELDS => "url=" . $img_url,
		CURLOPT_HTTPHEADER => array ("Authorization: Bearer " . $key_clarifai_token)
		)
	);
	$response = curl_exec($curl);
	if($response == FALSE) echo "Lol!!!";
	else {
		// Get the tags and their probabilities from clarifai
		$json = json_decode($response, true);
		$img_results = $json["results"]["0"]["result"]["tag"];
		$tags = $img_results["classes"];
		$probs = $img_results["probs"];
		print_tags($tags, $probs);
		// Remove the "nobody" tag, as it's irrelevant
		$nobody = array_search("nobody", $tags);
		if($nobody !== FALSE){
			unset($tags[$nobody]);
			unset($probs[$nobody]);
		}
		// Ensure that there are no more than 10 items in the arrays
		$count = count($tags);
		$min_val = "0";
		$max_tags = 10;
		if($count > $max_tags){
			for($x = 0; $x < $count-$max_tags; $x++){
				$idx = $count-$x;
				unset($tags[$idx]);
				$min_val = $probs[$idx];
				unset($probs[$idx]);
			}
		}
		// Scale each probaility between 1 and 100 after subtracting the min val
		foreach($probs as $key => $val){
			$probs[$key] = intval((floatval($val) - floatval($min_val)) * 1000);
			$x = $probs[$key] % 5;
			$probs[$key] -= $x;
		}
	}
	print_tags($tags, $probs);
	return array($tags, $probs);
}

function print_tags($tags, $probs){
	echo "Count: " . count($tags) . "<br>";
	foreach($tags as $key => $val){
		echo $key . " = " . $probs[$key] . "<br>";
	}
}

function get_tags_and_probs_strs($img_url){
	$tags_and_probs = get_tags_and_probs($img_url);
	echo "Tags and probs arrays:";
	var_dump($tags_and_probs);	
	echo "<br>";
	$tags_str = "";
	$probs_str = "";
	$x = 0;
	$count = count($tags_and_probs);
	foreach($tags_and_probs[0] as $key => $tag){
		$tags_str += $tag + (($x < $count - 1) ? "," : "");
		$x++;
	}
	$x = 0;
	foreach($tags_and_probs[1] as $key => $prob){
		$probs_str += $prob + (($x < $count - 1) ? "," : "");
		$x++;
	}
	return array($tags_str, $probs_str);
}

function add_img_to_db($img_url){
	$tags_and_probs = get_tags_and_probs_strs($img_url);
	echo "Tags and probs: ";
	var_dump($tags_and_probs);
	echo "<br>";
	$res = mysqli_query($link, "SELECT * FROM images WHERE url = '$img_url' LIMIT 1");
	if(mysqli_fetch_array($res) == false){
		mysqli_query($link, "INSERT INTO 'images'('url', 'tags' 'probs') VALUES ('" . $tags_and_probs[0] . "', " . $tags_and_probs[1] . ")");
	}else{
		mysqli_query($link, "UPDATE images SET tags='" . $tags_and_probs[0] . "', probs='" . $tags_and_probs[1] . "' WHERE url='$img_url'");
	}
}

add_img_to_db("http://www.freestockphotos.name/wallpaper-original/wallpapers/download-images-of-gentle-dogs-6866.jpg");
add_img_to_db("http://i.dailymail.co.uk/i/pix/2013/11/03/article-2486855-192ACC5200000578-958_964x682.jpg");
