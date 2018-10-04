<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="index.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   </head>
<body>
<div class="container">
	<div id="banner">
		<h1>World of Warcraft Ammos</h1>
		<p><a href="search.php" class="btn btn-primary">Search</a></p>
	</div>
	
	<div class="wrapermain">


		<main>
			<div class="hello"><?php
				include_once "class_category.php";
				include_once "class_form.php";
				include_once "class_user.php";
				include_once "class_admin.php";
				session_start();
				if(isset($_SESSION["user"]))
				{
					$user = unserialize($_SESSION["user"]);
					echo '<p>Hello '.ucfirst($user->getUsername()).'</p>';
				}
				else
				{
					header("Location: login.php");
				}
			?></div>


			<div class="row blopy"><?php
				if(isset($_GET["cat_id"]))
				{
					new Category($_GET["cat_id"]);
				}
			?></div>
		</main>
	
		<aside>
			<div><?php

			if($user->getAdmin() == 1)
			{
				new Form ( array(),"Administration", "admin.php");
			}
			?></div>
		
			<form method="post" action="logout.php">
				<div><button class="btn btn-lg btn-primary btn-block" type="submit">Logout</button></div>
			</form>

			<div>
				<?php
					include_once "class_category.php";
					new Category;
				?>
			</div>
		</aside>

	</div>
</div>
</body>
</html>
