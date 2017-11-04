<?php

	/**
	  * This class is used to auto include classes
	  * as and when they are required.
	*/

	/** ============================ **/
	/** === The Software Version === */
	$_software_version = "1.2.3";

	/** Start the session */
	session_start();

	/**
	  * Include any of the standalone helpers.
	*/
	require_once "auth-helpers.php";
	require_once "adminsidebar.php";

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
