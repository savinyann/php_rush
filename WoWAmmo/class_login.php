<?php
include_once "class_form.php";
include_once "class_query.php";
include_once "class_user.php";
include_once "class_admin.php";

class Login
{
	private $valid_name = FALSE;
	private $valid_mail = FALSE;
	private $valid_pass = FALSE;
	private $logemail;
	private $password;

	public function __construct()
	{
		$input["logemail"] = "Login / Email: ";
		$input["password"] = "Password: ";
		new Form($input, "Connect");
		//new Form(array(),"Subsribe", "inscription.php");
		$this->logemail = (isset($_POST["logemail"])) ? $_POST["logemail"] : NULL;
		$this->password = (isset($_POST["password"])) ? $_POST["password"] : NULL;
	}

	public function verify_login($post)
	{
		$this->valid_name = $this->verify_username($post["logemail"]);
		$this->valid_mail = $this->verify_email($post["logemail"]);
		$this->valid_pass = $this->verify_password($post["password"]);
		if($this->valid_mail && $this->valid_pass)
		{
			return("email");
		}
		elseif(($this->valid_name && $this->valid_pass))
		{
			return("username");
		}
		elseif($this->valid_pass)
			{
				echo '<p>Invalid email or login</p>';
				return(FALSE);
			}

	}

	private function verify_username($username)
	{
		if (strlen($username) < 3 || strlen($username) > 20)
		{
			return(FALSE);
		}
		return(TRUE);
	}


	private function verify_email($email)
	{
		if(!filter_var(strtolower($email), FILTER_VALIDATE_EMAIL))
		{
			return(FALSE);
		}
		return(TRUE);
	}

	private function verify_password($password)
	{
		if ((strlen($password) < 4) || (strlen($password) > 12))
		{
			echo '<p>Wrong password</p>';
			return(FALSE);
		}
		return(TRUE);
	}


	public function get_user($column, $value, $password)
	{
		$query = "SELECT * FROM users WHERE $column = ?";
		$variable = array($value);
		$SQL = new Query($query, $variable);
		$user = $SQL->SQLquery();
		$user = ($user) ? $user[0] : NULL;
		if($user == FALSE)
		{
			echo '<p>This login/email doesn\'t exist.</p>';
			return(NULL);
		}
		if(password_verify($password, $user["password"]))
		{
			$user_obj = ($user["admin"]) ? new Admin($user) : new User($user);
			return($user_obj);
		}
		else
		{
			echo '<p>Wrong password</p>';
			return(NULL);
		}
	}
}
?>
