<?php

 class database{
	private $host = "localhost";
	private $db_name = "pdo";
	private $username = "root";
	private $password ="";
	public $con ;

	public function databaseConnection()
	{
		$this->con = null;

		// try{
		// echo "tedst";
			$this->con = new PDO ("mysql:host=". $this->host. ";dbname=" . $this->db_name,$this->username, $this->password);
			// new PDO('mysql:host=localhost;dbname=test', $user, $pass);
			$this->con->exec("set name utf8");
			// echo "test";
			// print_r($this->con);
			// }catch(PDOExeception $exeception){

			// 	echo "Connection Error :". $exeception->getMessage();

			// }
			return $this->con;
		}
	}

	$database = new database();


?>