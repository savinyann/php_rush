<?php

class Verify_input
{
	protected $username;
	protected $email;
	protected $password;
	protected $password_conf;

	public function __construct($post)
	{
		$this->username = $post["username"];
		$this->email = $post["email"];
		$this->password = $post["password"];
		$this->password_conf = $post["password_conf"];
	}

	public function Verify_input($mod = 0)
	{
		$user_name = $this->verify_username();
		$user_email = $this->verify_email($mod);
		$user_pass = $this->verify_password();
		if($user_name && $user_email && $user_pass)
		{
			return(TRUE);
		}
		else
		{
			return(FALSE);
		}
	}


	private function verify_username()
	{
		if (strlen($this->username) < 3 || strlen($this->username) > 20)
		{
			echo "Invalid name <br>";
			return(FALSE);
		}
		return(TRUE);
	}


	private function verify_email($mod)
	{
		if(!filter_var(strtolower($this->email), FILTER_VALIDATE_EMAIL))
		{
			echo "Invalid email <br>";
			return(FALSE);
		}
		else
		{
			$query = "SELECT id FROM users WHERE email = ? LIMIT 1";
			$variable = array($this->email);
			$SQL = new Query($query, $variable);
			$user_id = $SQL->SQLquery()[0]["id"];
			if($user_id != NULL && $user_id != $mod)
			{
				echo "This email is already used.";
				return(FALSE);
			}
			return(TRUE);
		}
	}

	private function verify_password()
	{
		if ((strlen($this->password) < 4) || (strlen($this->password) > 12) || ($this->password != $this->password_conf))
		{
			echo "Invalid password or password confirmation.<br>";
			return(FALSE);
		}
		return(TRUE);
	}


}
?>
