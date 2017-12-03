<?php
	/**
	  * This class is used to handle the user
	  * objects. Although it can also be used
	  * to create a new account.
	*/

	require_once "bootstrap.php";

	class User {
		public $login_is_valid;

		public $name;
		public $email;
		public $username;
		public $id;
		public $exists;
		public $last_login;

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

				// Change the password to md5
				$password = md5($password);

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
					$this->exists = true;
					$this->last_login = $result['Last_Login'];
				}
			}
			else{
				// Get the users info from the database.
				$db = new Db();
				$db = $db->get();

				try{
					$query = $db->prepare("SELECT * FROM Users WHERE Username = '$username'");
					$query->execute();
				}
				catch(PDOException $e){
					die($e->getMessage());
				}

				$results = $query->fetchAll();
				if(count($results) > 0){
					$result = $results[0];
					$this->name = $result['Name'];
					$this->email = $result['Email'];
					$this->username = $result['Username'];
					$this->password = $result['Password'];
					$this->id = $result['ID'];
					$this->exists = true;
					$this->last_login = $result['Last_Login'];
				}
				else{
					die("Invalid user with username '$username'");
				}
			}
		}

      /**
        * Function used to update the users info in the
        * database.
      */
      public function update(){
          $db = new Db();
          $db = $db->get();
          try{
              $db->exec("UPDATE Users SET Name = '$this->name', Email = '$this->email', Password = '$this->password' WHERE ID = $this->id");
          }
          catch(PDOException $e){
              die($e->getMessage());
          }
          $db = null;
      }

      /**
        * Function used to delete the user.
      */
      public function delete(){
      	$db = new Db();
      	$db = $db->get();

      }

   	/**
   	  * Register a new login session.
   	*/
   	public function record_login(){
		$db = new Db();
		$db = $db->get();
		try{
			$db->exec("UPDATE Users SET Last_Login = now() WHERE Username = '$this->username'");
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
   	}

	/**
	  * Function used to check if any given
		* usernames or emails are in use.
		* @param $email The email
		* @param $password The password;
		* @return false - If not in use.
		* @return 'email' if the email is in use;
		* @return 'username' if the username is in use;
	*/
	public static function email_or_username_in_use($email, $username){
		if(isset($email) && isset($username)){
			$db = new Db();
			$db = $db->get();

			// Check if the email is in use.
			try{
				$query = $db->prepare("SELECT * FROM Users WHERE Email = '$email'");
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
			$results = $query->fetchAll();
			if(count($results) > 0){
				return 'email';
			}

			// Check if the username is in use
			try{
				$query = $db->prepare("SELECT * FROM Users WHERE Username = '$username'");
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
			$results = $query->fetchAll();
			if(count($results) > 0){
				return 'username';
			}

			// All is good. Return the default value.
			return false;
		}
	}

    /**
      * Function used to redirect an unloggedin user.
    */
    public static function require_login(){
      if(empty($_SESSION['loggedin']) || !$_SESSION['loggedin']){
      	redirect('index.php');
      	exit;
      }
    }

	/**
	  * Function used to get all the users
		* that have been created from the
		* database, or it will return false if
		* no users where found.
	*/
	public static function get_users(){
		$db = new Db();
		$db = $db->get();

		try{
			$query = $db->prepare("SELECT * FROM Users");
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}

		$result = $query->fetchAll();
		if(count($result) > 0){
			return $result;
		}
		else{
			return false;
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
			return $this->username;
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

			// Check if the password is encrtypted
			if(!strlen($password) == 32 && !ctype_xdigit($password)){
				$password = md5($password);
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
