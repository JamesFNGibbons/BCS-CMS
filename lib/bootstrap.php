<?php

	/**
	  * This class is used to auto include classes
	  * as and when they are required.
	*/

	/** ============================ **/
	/** === The Software Version === */
	if(file_exists('../.version')){
		$_software_version = file_get_contents('../.version');
	}

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
	  * Setup error reporting
	*/
	if(Install::is_complete()){
		if(Settings::get('error-reporting') == 'true'){
			error_reporting(E_ALL & ~E_NOTICE);
		}
		else{
			error_reporting(false);
		}
	}
	else{
		// For the installation process.
		error_reporting(E_ALL & ~E_NOTICE);
	}

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
	global $plugin_manager;
	$plugin_manager = new PluginManager();
	$plugin_manager->load_plugins();

	// Load the option manager
	global $option_manager;
	$option_manager = new OptionManager();
