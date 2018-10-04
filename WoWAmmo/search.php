<!DOCTYPE html>
<html>
<head>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<link rel="stylesheet" href="search.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="fullscreen_bg">
	<main>
		<div class="container">
			<div class="row">
				<nav>
					<p>WoW Ammos</p>
					<button class="btn btn-md btn-primary" type="submit">Log Out</button>
				</nav>

			</div>
			<div class="row">
				<?php
				include_once "class_search.php";
				include_once "class_form.php";
				include_once "class_product.php";

				$search = new Search();
				if(isset($_POST["int_id"]))
				{
					$match = $search->research($_POST);
				}
				?>
			</div>
		</div>
	</main>
</body>
</html>
