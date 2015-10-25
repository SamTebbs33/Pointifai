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
		<a href="" class="button button-blue button-cta" style = "width: 100%">Submit</a>
	</div>
	<div class="mobile mobile-countdown">
		<script>
		var canvas = document.getElementById('scoreCanvas');

		var guesses = 50;
		var guessCounter = guesses;
		var screenHeight = canvas.height;

		if(canvas.getContext){
			var ctx = canvas.getContext('2d');
			ctx.fillStyle = "#6382d9;";
			for(var x = 0; x < 100; x++){
				guessCounter -= guesses/100;
				ctx.fillRect(0,canvas.height - guessCounter * (screenHeight/100), canvas.width, guessCounter * (screenHeight/100));
				sleep(50);
			}
		}

		function sleep(milliseconds) {
		  var start = new Date().getTime();
		  for (var i = 0; i < 1e7; i++) {
		    if ((new Date().getTime() - start) > milliseconds){
		      break;
		    }
		  }
		}

		</script>
		<canvas id="scoreCanvas" width="100%" height="100%"></canvas>
		<p class="score">100</p>
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
