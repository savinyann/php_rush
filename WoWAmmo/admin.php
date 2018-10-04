<!DOCTYPE html>
<html>
<head>

	<!--link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css"-->
	<link rel="stylesheet" href="admin.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"></head>

<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<div class="container">
		<nav>
			<p>WoW Ammos</p>
			<button class="btn btn-md btn-primary" type="submit">Log Out</button>
		</nav>
	<main>

<?php
include_once "class_user.php";
include_once "class_admin.php";
session_start();
$user = unserialize($_SESSION["user"]);
if(isset($_SESSION["user"]))
{
	$user = unserialize($_SESSION["user"]);
	if($user->getAdmin() == 0)
		header("Location: index.php");
}
else
{
	header("Location: index.php");
}

if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case "add_user":
		$user->add_user(1);
		break;

		case "del_user":
		$user->del_user();
		break;

		case "mod_user":
		$user->mod_user();
		break;

		case "display_user":
		$user->display_user();
		break;

		case "add_prod":
		$user->add_prod();
		break;

		case "del_prod":
		$user->del_prod();
		break;

		case "mod_prod":
		$user->mod_prod();
		break;

		case "display_prod":
		$user->display_prod();
		break;

		case "add_cat":
		new Product;
		break;

		break;
	}
}
?>

	</main>


	<aside>
		<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    User Options
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="admin.php?action=add_user">Creating an user</a><br>
    <a class="dropdown-item" href="admin.php?action=del_user">Deleting a user</a><br>
    <a class="dropdown-item" href="admin.php?action=mod_user">Editing a user</a><br>
	 <a class="dropdown-item" href="admin.php?action=display_user">Displaying a user</a><br>
  </div>
</div>

<div class="dropdown show">
<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Product Options
</a>

<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" href="admin.php?action=add_cat">Adding a new category</a><br>
<a class="dropdown-item" href="admin.php?action=add_prod">Adding a new product</a><br>
<a class="dropdown-item" href="admin.php?action=del_prod">Deleting a product</a><br>
<a class="dropdown-item" href="admin.php?action=mod_prod">Editing a product</a><br>
<a class="dropdown-item" href="admin.php?action=display_prod">Displaying a product</a>
</div>
</div>

	</aside>

</body>
</html>
