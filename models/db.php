<?php

	/**
	 * 
	 */
	class DB
	{
		private $user;
		private $pass;
		private $db = "crm";
		private $host = "localhost";

		private $DBInstance = null; 

		public function __construct($user, $pass){
			$this->user = $user;
			$this->pass = $pass;
			$this->DBInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass);
			$this->DBInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->DBInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}

		public function getInstance(){
			return $this->DBInstance;
		}
	}

?>