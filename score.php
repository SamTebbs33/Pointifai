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

?>
