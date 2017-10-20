<?php
	
	/**
	  * This class is used to auto include classes 
	  * as and when they are required.
	*/

	/** Start the session */
	session_start();

	/**
	  * Function called when a class instance
	  * is created.
	  * @param $className The name of the class.
	*/
	function __autoload($className){
		require_once($className . '.php');
	}