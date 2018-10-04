<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="codingpedia.css">
	<title></title>
</head>
<body>
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

		default:
		
		break;
	}
}

?>

	</main>
	<aside>
		<div><ul>
			<li><a href="admin-test.php?action=add_user">Creating an user</a></li>
			<li><a href="admin-test.php?action=del_user">Deleting an user</a></li>
			<li><a href="admin-test.php?action=mod_user">Editing an user</a></li>
			<li><a href="admin-test.php?action=display_user">Displaying an user</a></li>
		</ul></div>

		<div><ul>
			<li><a href="admin-test.php?action=add_prod">Adding a new product</a></li>
			<li><a href="admin-test.php?action=del_prod">Deleting a product</a></li>
			<li><a href="admin-test.php?action=mod_prod">Editing a product</a></li>
			<li><a href="admin-test.php?action=display_prod">Displaying a product</a></li>
		</ul></div>
	</aside>
</body>
</html>

