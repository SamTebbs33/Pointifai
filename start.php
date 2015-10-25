<?php 
require_once 'config.php';
if (@$_SERVER['PHP_AUTH_USER'] == $key_user && @$_SERVER['PHP_AUTH_PW'] == $key_pass) {
	include('templates/header.php'); 

	$game_state = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2];

	if (isset($_GET['state'])) {
		if ($game_state == 9 && $_GET['state'] == 'reset') {
			$blah = mysqli_query($link, "DELETE FROM participants");
			$blahblah = mysqli_query($link, "UPDATE settings SET val='0' WHERE field = 'state'");
			echo("<script>window.location = '/';</script>");
		}
	}

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
		push_new_q($pusher, ($game_state + 1) / 2);
		$round = ($game_state + 1) / 2;
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
					<?php require_once 'score.php'; ?>
					<?php foreach (get_leaderboard($link) as $key => $value) {
						?>
						<tr>
							<td><?php echo $value; ?></td>
							<td><?php echo $key; ?></td>
						</tr>
						<?php
					} ?>
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
		<?php 
			require_once 'score.php';
			$leaderboard = get_leaderboard($link);
			$winner_points = reset($leaderboard);
			$winner_name = array_search($winner_points, $leaderboard);
		?>
		<div class="welcome">
			<h1 class="logo animated infinite pulse winner_name"><?php echo $winner_name; ?></h1>
			<h2 class="winner_points"><?php echo $winner_points; ?> pts</h2>
			<a href="/start.php?state=reset" class="button button-white-stroke button-cta">Back to menu</a>
		</div>
	</body>
		<?php
	}
	include('templates/footer.php'); 
} else {
	header('WWW-Authenticate: Basic realm="yolobanter"');
    header('Status: 401 Unauthorized');
    /* Special Header for CGI mode */
    header('HTTP-Status: 401 Unauthorized');
}
?>
