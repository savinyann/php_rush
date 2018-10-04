<?php

class Query
{
	private $_query;
	private $_pdo;
	private $_variable;

	public function __construct($query, $variable = array())
	{
		$this->_pdo = $this->connect_db("pool_php_rush");
		$this->_query = $query;
		$this->_variable = $variable;
	}


	public function SQLquery()
	{
		$res = $this->_pdo->prepare($this->_query);
		$res->execute($this->_variable);
		$result = $res->fetchAll();
		return($result);
	}


		private function connect_db($db = FALSE, $host = "localhost", $username = "root", $password = "root", $port = FALSE)
	{
			$pdo = new PDO("mysql:host=".$host.";dbname=".$db, $username, $password);
			return($pdo);
	}
}
?>
