<?php

	/*
	________                          ______            _________                               _____                 ________     ____________
___  __ )____________________________  /______      __  ____/____________ _______________  ___  /_____________    __  ___/________  __/_  /___      _______ ____________
__  __  |  _ \_  ___/__  __ \  __ \_  //_/  _ \     _  /    _  __ \_  __ `__ \__  __ \  / / /  __/  _ \_  ___/    _____ \_  __ \_  /_ _  __/_ | /| / /  __ `/_  ___/  _ \
_  /_/ //  __/(__  )__  /_/ / /_/ /  ,<  /  __/     / /___  / /_/ /  / / / / /_  /_/ / /_/ // /_ /  __/  /        ____/ // /_/ /  __/ / /_ __ |/ |/ // /_/ /_  /   /  __/
/_____/ \___//____/ _  .___/\____//_/|_| \___/      \____/  \____//_/ /_/ /_/_  .___/\__,_/ \__/ \___//_/         /____/ \____//_/    \__/ ____/|__/ \__,_/ /_/    \___/
                    /_/                                                      /_/
	*/

require_once "lib/bootstrap.php";

// Check if the install has been completed
if(!Install::is_complete()){
	header('Location: install');
}

// Set the error mode based of the config in the db
if(Settings::get('running_mode')) $running_mode = Settings::get('running_mode');
else $running_mode = 'production';
if($running_mode == 'production'){
	error_reporting(0);
}
else{
	error_reporting(E_ALL);
}

// Check if the .htaccess file exists, if not, create it.
if(!file_exists('.htaccess')){
	$default_contents = file_get_contents('lib/defaults/.htaccess.default');
	file_put_contents('.htacces', $default_contents) or include('system-views/alerts/htaccess-writable.php');
}

// Check if the website is in maitence mode
if(Settings::get('maintenance')){
	include('system-views/maintence.php');
}
else{
	// Check if there is a specific page request
	if(isset($_GET['page'])){
		$page = new Page(Page::get_id_from_uri($_GET['page']));
		if($page->exists){
			// Setup the page template helpers.
			$the_page = $page;
			require_once "lib/template.php";
			include('template/header.tpl.php');
			include "template/page.tpl.php";
		}
		else{
			// Display the 404 error
			if(file_exists('template/404.tpl.php')){
				include 'template/404.tpl.php';
			}
			else{
				print "404. Page not found.";
			}
		}
	}
	else{
		include('template/index.tpl.php');
	}
}
