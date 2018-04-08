<?php
	require_once('phpscripts/config.php');

?>

<?php
	require_once('phpscripts/config.php');
	if(isset($_GET['id'])) {
		//get the movie
		$tbl = "tbl_movies";
		$col = "movies_id";
		$id = $_GET['id'];
		$getMovie = getSingle($tbl, $col, $id);

	}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>The one ring to control all rings...</title>
</head>
<body>
	<?php
		$tbl = "tbl_movies";
		$col = "movies_id";
		$id = $_GET['id'];
		echo single_edit($tbl, $col, $id);

		if(!is_string($getMovie)) {
			$row=mysqli_fetch_array($getMovie);
			echo "
		<img src=\"../images/{$row['movies_cover']}\" alt=\"{$row['movies_title']}\">
		<video autoplay controls>
		<source src=\"../videos/{$row['movies_trailer']}\">
		</video>
		";


		}else{
			echo "<p>{$getMovie}</p>";
		}
	?>
</body>
</html>
