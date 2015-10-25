<?php include('templates/header.php'); 

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2];

// Initial registration page
if (isset($_GET['state'])) {
	if ($game_state + 1 == $_GET['state']) {
		$blah = mysqli_query($link, "UPDATE settings SET val='" . mysqli_escape_string($link, $_GET['state']) . "' WHERE field = 'state'");
		$game_state++;
	}
}

if ($game_state == "0") { ?>
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

// Question pages
else if (($game_state > 0 && ($game_state % 2 != 0) && $game_state < 9)) {
	push_new_q($pusher);
	// $new_val = $game_state + 1;
	// $state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
	// $state = substr($round[2], 0, 1);
	$img = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = $round"));
	$url = $img[1];
?>
<body class="host<?php if(strlen($game_state) == 1) { echo " timer"; } ?>" data-state="<?php echo $game_state; ?>" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
	<div class="desktop centre">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<div class="timer"><span class="seconds"></span>s remaining...</div>
		<img src="<?php echo $url ?>" alt="Question Image" class="question-image">
	</div>
</body>
<?php
} 
// Leaderboard
else if ($game_state > 0 && ($game_state % 2 == 0) && $game_state < 9) {
	push_end_q($pusher);
	?>
	<body class="host<?php if(strlen($game_state) == 1) { echo " timer"; } ?>" data-state="<?php echo $game_state; ?>" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
		<div class="desktop centre">
			<header class="logo">Pointif<span class="text-blue">ai</span></header>
			<table class="leaderboard">
				<tr>
					<td>100</td>
					<td>clarifai-bob</td>
					<td>...</td>
				</tr>
				<tr>
					<td>75</td>
					<td>clarifai-dave</td>
					<td></td>
				</tr>
				<tr>
					<td>50</td>
					<td>clarifai-sarah</td>
					<td>...</td>
				</tr>
				<tr>
					<td>25</td>
					<td>clarifai-user</td>
					<td>...</td>
				</tr>
			</table>
			<a href="/start.php?state=<?php echo $game_state + 1; ?>" class="button button-cta button-blue">Next question</a>
		</div>
	</body>
	<?php
}
else if ($game_state > 8) {
	?>
<body style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;">
	<script>
		var audio = new Audio('audio/end_theme.wav');
		audio.play();
	</script>
	<div class="welcome">
		<h1 class="logo animated infinite pulse winner_name">Samuel Tebbs</h1>
		<h2 class="winner_points">100 pts</h2>
		<a href="index.php" class="button button-white-stroke button-cta">Back to menu</a>
	</div>
</body>
	<?php
}
include('templates/footer.php'); ?>
