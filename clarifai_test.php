<?php

$secret = parse_ini_file("secret.txt");

$curl = curl_init();
$img_url = "http://www.lucozadeenergy.com/product_images/_orig/132.jpg";
echo "<img src=\"$img_url\" width=\"100%\">";
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.clarifai.com/v1/tag/",
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_POSTFIELDS => "url=" . $img_url,
	CURLOPT_HTTPHEADER => array ("Authorization: Bearer " . $secret["clarifai_access_token"])
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
	// Remove the "nobody" tag, as it's irrelevant
	$nobody = array_search("nobody", $tags);
	if($nobody !== FALSE){
		unset($tags[$nobody]);
		unset($probs[$nobody]);
	}
	print_tags($tags, $probs);
	// Ensure that there are no more than 10 items in the arrays
	$count = count($tags);
	if($count > 10){
		for($x = 0; $x < $count-10; $x++){
			unset($tags[$count-1-$x]);
			unset($probs[$count-1-$x]);
		}
	}
	print_tags($tags, $probs);
}

function print_tags($tags, $probs){
	echo "<br>Count: " . count($tags) . "<br>";
	foreach($tags as $key => $val){
		echo $val . " = " . $probs[$key] . "<br>";
	}
}
?>
