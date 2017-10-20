<?php
	require_once "../lib/bootstrap.php";
	require_once('partials/header.php');

	// Set the default current_step variable.
	if(!isset($_SESSION['current_step'])){
		$_SESSION['current_step'] = 1;
	}

	// Take the user to the correct step.
	if(!isset($_GET['step'])){
		if(isset($_SESSION['current_step'])){
			header('Location: index.php?step=' . $_SESSION['current_step']);
		}
		else{
			header('Location: index.php?step=1');
		}
	}
	else{
		// Take the user to the correct place
		if(!$_GET['step'] == $_SESSION['current_step']){
			header('Location: index.php?step=' . $_SESSION['current_step']);
		}
	}

	// Get the step of the install process.
	switch($_GET['step']){
		case('1'):
			// Work out if the config file is writable
			if(is_writable('../config/config.php')){
				$config_is_writable = true;
			}
			else{
				$config_is_writable = false;
			}

			if(
				isset($_GET['hostname']) &&
				isset($_GET['database']) &&
				isset($_GET['username']) &&
				isset($_GET['password'])
			){
				$username = $_GET['username'];
				$database = $_GET['database'];
				$hostname = $_GET['hostname'];
				$password = $_GET['password'];

				// Generate the new config file
				$conf = file_get_contents('../config/config-sample.php');
				$conf = str_replace('%username%', $username, $conf);
				$conf = str_replace('%password%', $password, $conf);
				$conf = str_replace('%hostname%', $hostname, $conf);
				$conf = str_replace('%database%', $database, $conf);

				// Write to the real config file.
				file_put_contents('../config/config.php', $conf);

				/**
				  * Loop through the models in the models 
				  * directory. And then close the db connection.
				*/
				$db = new Db();
				$db = $db->get();
				foreach(glob('../models/*') as $file){
					if(!is_dir($file)){
						try{
							$filename = basename($file);
							$sql = file_get_contents('../models/' . $filename);
							$db->exec($sql);
						}
						catch(PDOException $e){
							die($e->getMessage());
						}
					}
				}
				$db = null;

				// Move onto the next step
				$_SESSION['current_step'] = 2;
				header('Location: index.php?step=' . $_SESSION['current_step']);
			}
			else{
				// Render the template
				include('html/step1.php');
			}

		break;

		case('2'):
			if(isset($_GET['title']) && isset($_GET['subtitle'])){
				$title = $_GET['title'];
				$subtitle = $_GET['subtitle'];

				// Add the new settings to the database.
				Settings::set('title', $title);
				Settings::set('subtitle', $subtitle);

				// Take the user to the next step
				$_SESSION['current_step'] = 2;
				header('Location: index.php?step=2');
			}
			else{
				include('html/step2.php');
			}
		break;

		default:
			die('Inavlid request.');
	}