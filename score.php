<?php

require_once "config.php";

function get_leaderboard($link){
	$result = mysqli_query($link, "SELECT * FROM participants");
	$leaderboard = [];
	while($row = $result->fetch_assoc()){
		$leaderboard[$row[1]] = $row[2];	
	}
	arsort($leaderboard);
	return $leaderboard;
}

?>
