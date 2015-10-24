<?php

require "config.php";

function get_leaderboard(){
	$result = mysqli_query($link, "SELECT * FROM participants");
	$leaderboard = [];
	while($row = $result->fetch_assoc()){
		$leaderboard[$row[1]] = $row[2];	
	}
	return json_encode($leaderboard);
}

?>
