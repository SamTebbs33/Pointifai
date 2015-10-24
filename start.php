<?php include('templates/header.php'); 

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2];

if ($game_state == "0" && !isset($_GET['state'])) { ?>
<body class="host" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
	<div class="desktop centre">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<h2>Waiting for players<span class="infinite flash">...</span></h2>
		<h3>Current players:</h3>
		<ul class="player-list">
		</ul>
		<a href="?state=1" class="button button-blue button-cta">Start Game</a>
	</div>
</body>
<?php 
}

if ($game_state == "1" || isset($_GET['state'])) {
	push_new_q($pusher);
?>
<body class="host" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
	<div class="desktop centre">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<h2>Waiting for players<span class="infinite flash">...</span></h2>
		<h3>Current players:</h3>
		<ul class="player-list">
		</ul>
		<a href="?state=1" class="button button-blue button-cta">Start Game</a>
	</div>
</body>
<?php
}
include('templates/footer.php'); ?>
