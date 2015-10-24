<?php include('templates/header.php');

$round = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM settings WHERE field = 'round'"));
$round = $round[2];
$img = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM images WHERE id = $round"));
$url = $img[0];
$tags_and_probs = explode(",", $img[1]);
$tags = [];
foreach($tags_and_probs as $key => $val){
	$exploded = explode(";", $val);
	$tags[$key] = $exploded[0];
	$probs[$key] = $exploded[1];
}
?>
<body>
	<div class="desktop">
		<header class="logo">Pointif<span class="text-blue">ai</span></header>
		<table class="question-view">
			<tr>
			<td><img src="<?php echo $url ?>" alt="Question Image" class="question-image"></td>
				<td>
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
				</td>
			</tr>
		</table>
	</div>
</body>
<?php include('templates/footer.php'); ?>
