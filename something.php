<?php

include "config.php";

$name = $_POST["name"];
$q_id = $_POST["q_id"];
$tag = $_POST["tag"];

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))["val"];
$tags_and_probs = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = " . mysqli_real_escape_string($link, $q_id)));
var_dump($tags_and_probs);
$tags = explode(",", $tags_and_probs["tags"]);
$probs = explode(",", $tags_and_probs["probs"]);
var_dump($tags);
var_dump($probs);
if($q_id == ($game_state + 1) / 2){
	echo "q id ok<br>";
	foreach($tags as $key => $val){
		if($tags[$key] == $tag){
			$name = mysqli_real_escape_string($link, $name);
			$pts = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM participants WHERE name = $name"));
			$pts += 100 - intval($probs[$key]);
			mysql_query($link, "UPDATE participants SET points = '" . intval($pts) . "' WHERE name = $name");
		}
	}
}
?>
