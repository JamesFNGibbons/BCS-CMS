<?php
	/**
	  * Class used to create and edit the config.php
	  * file.
	*/

	require_once "bootstrap.php";

	class Config {
		/**
		  * Function used to get a config key, or false if the key does not exist.
		  * @param $key The key ID
		  * @return $value The value of the config key
		*/
		public static function get($key){
			if(isset($key)){
				/* Load up the config.php file */
				require_once('config/config.php');
				$config_file = new ConfigFile();
				$value = $config_file->get()[$key];

				if(isset($value)){
					return $value;
				}
				else{
					return false;
				}
			}
		}
	}
