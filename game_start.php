<?php

include "config.php";

$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
$num_pps = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'num_pps'"));
echo "Round: " . $round[2] . "<br>";
echo "Num pps: " . $num_pps[2] . "<br>";

?>
