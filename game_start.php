<?php

include "config.php";

$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
$round = $round[2];
$num_pps = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'num_pps'"));
$num_pps = $num_pps[2];

if($round <= 5){
	$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = '$round'"));
	$url = $round[1];
	$tags = $round[2];
	$pps = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM participants"));
	var_dump($pps);
}

?>
