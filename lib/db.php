<?php
	/**
	  * Class used to create and handle a connection
	  * to the database.
	*/

	class Db {

		private $db;

		/**
		  * Constructor used to create a connection
		  * to the database.
		  * @return $db The database PDO object.
		*/
		public function __construct(){
			// Get the mysql config from the config file.
			$user = Config::get('db_username');
			$password = Config::get('db_password');
			$host = Config::get('db_hostname');
			$database = Config::get('db_database');

			$this->db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this->db;
		}

		/**
		  * Function used to get the database connection,
		  * @return $this->db The database connection.
		*/
		public function get(){
			return $this->db;
		}


		/**
		  * Function used to close the database connection
		*/
		public function close(){
			$this->db->close();
		}
	}
