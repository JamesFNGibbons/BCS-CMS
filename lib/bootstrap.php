<?php

	/**
	  * This class is used to auto include classes
	  * as and when they are required.
	*/

	/** Start the session */
	session_start();

	/**
	  * Include any of the standalone helpers.
	*/
	require_once "auth-helpers.php";
	require_once "adminsidebar.php";

	/**
		* Defines the connection URL to our servers.
		* The software will not work without this.
	*/
	define("BCS_LM_URL", "http://localhost/cms-lm");

	/**
	  * Function called when a class instance
	  * is created.
	  * @param $className The name of the class.
	*/
	function __autoload($className){
		if(!class_exists($className)){
			$className = strtolower($className);
			include_once($className . '.php');
		}
	}

	/**
	  * Ommit the powered by header
	*/
	header('x-powered-by', 'Bespoke Computer Software Web PRO');

	// Load the plugins
	$plugin_manager = new PluginManager();
	$plugin_manager->load_plugins();
