<?php
include_once "class_pdo.php";
include_once "SQLquery.php";
include_once "class_user.php";



function log_user($column, $value, $password)
{
	$rush = connect_db("pool_php_rush");
	$query = "SELECT * FROM users WHERE $column = ?";
	$array = array($value);
	$result = SQLquery($rush, $query, $array);
	$user = array();
	$users = $result->fetch();
	$result->closecursor();
	if($users == FALSE)
	{
		return(NULL);
	}
	foreach ($users as $key => $value)
	{
		if(!is_integer($key))
		{
			$user["$key"] = $value;
			$user["1"] = "Bla";
		}
	}
	if(password_verify($password, $user["password"]))
	{
		$user_obj = new User($user);
		return($user_obj);
	}
	else
	{
		return(NULL);
	}
}
?>
