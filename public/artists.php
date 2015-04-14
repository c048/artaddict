<?php
	if(isset($_GET['artist']))
		$artistName = $_GET['artist'];
?>
<!DOCTYPE HTML>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<title>Artaddict.eu | Artists</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="css/bkgnd/2_bk.css" />
		<link rel="icon" href="assets/siteart/favicon.ico" type="image/x-icon">
	</head>

	<body>
		
		<?php include("header.php"); ?>
		<?php include("nav.php"); ?>
		
		<section id="cSingleColumn">
			<div id="bBreadCrumb">
				<ul>
					<li>
						<a href="./">home</a>&nbsp;/
					</li>
					<li>
						<a href="artists.php">artists</a>&nbsp;/&nbsp;
					</li>
					<?php
						if(isset($artistName)){
					?>
					<li>
						<a href="artists.php?artist=<?php print($artistName) ?>"><?php print($artistName) ?></a>&nbsp;
					</li>
					<?php
						}
					?>
				</ul>
			</div>

			<?php 
				if(isset($artistName))
					include("artists/products.php"); 
				else
					include("artists/index.php"); 
			?>
		</section>

		<script src="js/script_base.js" type="text/javascript"></script>
		
	</body>

</html>