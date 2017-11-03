<?php
	/**
	  * This class is used to handle the installation
	  * process, and the status of the process.
	*/

	require_once "bootstrap.php";

	class Install {
		/**
		  * Function used to check if the install has been completed.
		  * @return $completed Boolean if the install has been completed.
		*/
		public static function is_complete(){
			// Check if the config file is empty
			$config_file = file_get_contents('../config/config.php');
			if(empty($config_file)){
				return false;
			}

			if(Settings::get('install_status') == '1'){
				return true;
			}
			else{
				return false;
			}
		}
	}
