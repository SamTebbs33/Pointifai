<?php

include "config.php";

$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
$round = $round[2];

if($round <= 5){
	$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = '$round'"));
	$url = $round[1];
	$tags = $round[2];
	$pps = mysqli_query($link, "SELECT * FROM participants");
	while($row = $pps->fetch_assoc()){
		var_dump($row);
		echo "<br>";
	}
}

?>
