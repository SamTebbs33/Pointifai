<?php

include "config.php";
var_dump($_POST);
$name = $_POST["name"];
$q_id = $_POST["q_id"];
$tag = $_POST["tag"];

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"));
$game_state = $game_state["val"];
$tags_and_probs = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = " . mysqli_real_escape_string($link, $q_id)));
$tags = explode(",", $tags_and_probs["tags"]);
$probs = explode(",", $tags_and_probs["probs"]);
echo "Q ID: $g_id<br>";
echo "State: $game_state<br>";
if(intval($q_id) == (intval($game_state) + 1) / 2){
	echo "q id ok<br>";
	foreach($tags as $key => $val){
		if($tags[$key] == $tag){
			$name = mysqli_real_escape_string($link, $name);
			$pts = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM participants WHERE name = $name"));
			$pts += 100 - intval($probs[$key]);
			mysql_query($link, "UPDATE participants SET points = '" . intval($pts) . "' WHERE name = $name");
			break;
		}
	}
}
?>
