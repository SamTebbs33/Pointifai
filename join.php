<?php include('templates/header.php');
if (mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'state'"))[2] == "0") {
?>
<body class="mobile-controller centre">
	<div class="mobile mobile-name">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<p>Enter your name:</p>
		<input type="text">
		<br>
		<a class="button button-blue">Go</a>
	</div>
	<div class="mobile mobile-message">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<p class="message">Waiting...</p>
	</div>
	<div class="mobile mobile-enter-tag">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<p class="score">0</p>
		<p class="rank">1st</p>
		<p><input type="text" placeholder="Enter tag..." style="width: 100%;"></p>
		<a href="" class="button button-blue button-cta">Submit</a>
	</div>
	<div class="mobile mobile-countdown">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<p>100</p>
	</div>
</body>
<?php
} else {
	?>
<body class="mobile-controller centre">
	<div class="">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<p>A game is already in progress</p>
	</div>
</body>
	<?php
}
include('templates/footer.php'); ?>
