<?php
	/**
	  * This class is used to handle the user
	  * objects. Although it can also be used
	  * to create a new account.
	*/
	class User {
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
