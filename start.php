<?php include('templates/header.php'); 

$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2];

if ($game_state == "0" && !isset($_GET['state'])) { ?>
<body class="host" data-state="<?php echo $game_state; ?>" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
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
	$blah = mysqli_query($link, "UPDATE settings SET val='1' WHERE field = 'state'");
	$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
	$round = substr($round[2], 0, 1);
	$img = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = $round"));
	$url = $img[1];
?>
<body class="host<?php if(strlen($game_state) == 1) { echo " timer"; } ?>" style="background-image: url('/img/stars.jpeg'); background-size:cover; background-position: center; color: white;"> 
	<div class="desktop centre">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<?php if(strlen($game_state) == 1) { ?>
			<div class="timer"><span class="seconds"></span>s remaining...</div>
			<img src="<?php echo $url ?>" alt="Question Image" class="question-image">
		<?php } else { ?>
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
		<?php } ?>
	</div>
</body>
<?php
}
include('templates/footer.php'); ?>
