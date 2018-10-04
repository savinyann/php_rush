<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="login.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
	<div class="fullscreen_bg">
	<div class="login">
		<h1>Sign In</h1>

		<?php
		include_once "class_login.php";
		$login = new Login;
		if(isset($_POST["logemail"]))
		{
			$logemail = $login->verify_login($_POST);
		}
		if(isset($logemail) && $logemail == TRUE)
		{
			$user = $login->get_user($logemail, $_POST["logemail"], $_POST["password"]);
			if ($user != NULL)
			{
				session_start();
				$_SESSION["user"] = serialize($user);
				header("Location: index.php");
			}
		}
		?>
		<p>Not yet a member? <a href="inscription.php">Register!</a></p>
	</div>
</div>
</body>
</html>
