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
			if(!defined('CONF-init') && constant('CONF-init')){
				return false;
			}
			else{
				if(Settings::get('install_status') == '1'){
					return true;
				}
				else{
					return false;
				}
			}
		}
	}
