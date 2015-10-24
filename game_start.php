<?php

include "/secure/auth.php";

$round = mysql_query("SELECT * FROM misc WHERE field = 'round'");
$num_pps = mysql_query("SELECT * FROM misc WHERE field = 'num_pps'");
echo "Round: " . $round . "<br>";
echo "Num pps: " . $num_pps . "<br>";

?>
