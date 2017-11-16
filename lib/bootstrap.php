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

	/**
	  * Function used to redirect the user.
		* @param $url The URL to redirect to.
	*/
	function redirect($url){
		if(!empty($url)){
			print "<script>window.location.assign('$url');</script>";
		}
	}

	/** Start the session */
	session_start();

	/**
	  * Include the config file.
	*/
	require_once "config/config.php";

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
	  * Function used to include a javascript file
		* that is stored in the js sub dir in the lib
		* folder. This should only be used to include
		* a code that is essential to the core, not the
		* template.
	*/
	function get_core_js($file){
		if(file_exists("../lib/js/$file")){
			$inc = "<script src='../lib/js/$file'></script>";
			print $inc;
		}
		else{
			die("Cannot include js file $file");
		}
	}

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
			// Include the configFile class only if the install is complete.
			if(strtolower($className) == 'configfile'){
				if(Install::is_complete()){
					$className = strtolower($className);
					include_once($className . '.php');
				}
			}
			else{
				$className = strtolower($className);
				include_once($className . '.php');
			}
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

	if(Install::is_complete()){
		// Load the plugins
		global $plugin_manager;
		$plugin_manager = new PluginManager();
		$plugin_manager->load_plugins();

		// Load the option manager
		global $option_manager;
		$option_manager = new OptionManager();
	}
