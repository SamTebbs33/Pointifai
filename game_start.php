<?php

include "config.php";

$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM misc WHERE field = 'round'"));
$num_pps = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM misc WHERE field = 'num_pps'"));
echo "Round: " . $round . "<br>";
echo "Num pps: " . $num_pps . "<br>";

?>
