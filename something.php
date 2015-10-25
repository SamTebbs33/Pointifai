<?php

include "config.php";

$name = $_POST["name"];
$q_id = $_POST["q_id"];
$tag = $_POST["tag"];

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2];
$tags_and_probs = explode(",", mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = " . mysqli_real_escape_string($link, $q_id))));
$tags = explode(",", $tags_and_probs[0]);
$probs = explode(",", $tags_and_probs[1]);
if($q_id == ($game_state + 1) / 2){
	foreach($tags as $key => $val){
		if($tags[$key] == $tag){
			$name = mysqli_real_escape_string($link, $name);
			$pts = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM participants WHERE name = $name"));
			$pts += 100 - intval($probs[$key]);
			mysql_query($link, "UPDATE participants SET points = " . intval($pts) . " WHERE name = $name");
		}
	}
}
?>
