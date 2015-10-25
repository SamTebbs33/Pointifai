<?php

require_once "config.php";

function get_leaderboard($link){
	$result = mysqli_query($link, "SELECT * FROM participants");
	$leaderboard = [];
	while($row = $result->fetch_assoc()){
		$leaderboard[$row["name"]] = $row["points"];	
	}
	arsort($leaderboard);
	return $leaderboard;
}

function get_tags($link, $state){
	$result = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id=" . ($state + 1) / 2));
	$tags = $result[2];
	$probs = $result[3];
	$ret_val = [];
	foreach($tags as $key => $val){
		$ret_val[$val] = $probs[$key];
	}
	return $ret_val;
}

?>
