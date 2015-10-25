<?php

$secret = parse_ini_file("secret.txt");

$curl = curl_init();
$img_url = "http://pointifai.com/img/stars.jpeg";
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
	print_tags($tags, $probs);

}

function print_tags($tags, $probs){
	echo "<br>Count: " . count($tags) . "<br>";
	foreach($tags as $key => $val){
		echo $val . " = " . $probs[$key] . "<br>";
	}
}
?>
