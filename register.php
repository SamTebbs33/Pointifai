<?php

require_once 'config.php';

$round = mysqli_query($link, "INSERT INTO `participants`(`name`, `points`) VALUES ('" . mysqli_escape_string($link, $_POST['name']) . "', 0)");
