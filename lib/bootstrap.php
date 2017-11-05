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
	  * Allow php to use more memory
	*/
	ini_set('memory_limit', '-1');

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
		* Checks if a update check is needed
	*/
	if(Install::is_complete()){
		$last_update_date = new DateTime(Settings::get('last_update'));
		$next_update_date = $last_update_date->add(new DateInterval('P1D'));
		$the_date = new DateTime();
		if($next_update_date <= $the_date){
			Settings::set('force-update', 'true');
		}
	}

	// Load the plugins
	$plugin_manager = new PluginManager();
	$plugin_manager->load_plugins();
