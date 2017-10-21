<?php
	/**
	  * This class is used to handle the user
	  * objects. Although it can also be used
	  * to create a new account.
	*/

	require_once "bootstrap.php";

	class User {
		public $login_is_valid;

		private $name;
		private $email;
		private $username;
		private $id;

		/**
		  * Constructor used to setup the user object. It
			* will verify a users login if the password variable
			* is defined.
			* @param $username The username of the user
			* @param $password The password of the user.
		*/
		public function __construct($username, $password = false){
			if($password !== false){
				$db = new Db();
				$db = $db->get();

				try{
					$query = $db->prepare("SELECT * FROM Users WHERE Username = '$username' and Password = '$password'");
					$query->execute();
				}
				catch(PDOException $e){
					die($e->getMessage());
				}

				$results = $query->fetchAll();
				if(count($results) > 0){
					$this->login_is_valid = true;
				}
				else{
					$this->login_is_valid = false;
				}

				if($this->login_is_valid){
					$result = $results[0];
					$this->name = $result['Name'];
					$this->email = $result['Email'];
					$this->username = $result['Username'];
					$this->id = $result['ID'];
				}
			}
			else{
				// Get the users info from the database.
				$db = null;
			}
		}

		/**
      * Function used to get the ID of the user
			* @return the users ID;
		*/
		public function get_id(){
			return $this->id;
		}

		/**
      * Function used to get the Name of the user
			* @return the users Name;
		*/
		public function get_name(){
			return $this->name;
		}

		/**
      * Function used to get the username of the user
			* @return the users username;
		*/
		public function get_username(){
			return $this->usernam;
		}

		/**
      * Function used to get the email of the user
			* @return the users email;
		*/
		public function get_email(){
			return $this->email;
		}

		/**
		  * Function used to create a new user
		  * account in the database.
		  * @param $name The users name
		  * @param $email The users email
		  * @param $username The users username
		  * @param $password The users password
		  * @return $id The new users ID
		*/
		public static function create_user($name, $email, $username, $password){
			// Check if the new username already exist
			$db = new Db();
			$db = $db->get();

			try{
				$query = $db->prepare("SELECT * FROM Users WHERE Username = '$username'");
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}

			if(count($query->fetchAll()) > 0){
				return false;
			}

			// Check if the users email is not already in use.
			try{
				$query = $db->prepare("SELECT * FROM Users WHERE Email = '$email'");
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}

			if(count($query->fetchAll()) > 0){
				return false;
			}

			// Add the new user to the database.
			try{
				$db->exec("INSERT INTO Users (Name, Email, Username, Password) VALUES ('$name', '$email', '$username', '$password')");
			}
			catch(PDOException $e){
				die($e->getMessage());
			}

			// Get the ID of the new user.
			try{
				$query = $db->prepare("SELECT * FROM Users WHERE Username = '$username'");
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}

			$result = $query->fetchAll()[0];
			return $result['ID'];
		}

	}
