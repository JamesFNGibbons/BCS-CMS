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

// Include the template helpers
require_once "lib/template.php";

// Set the error mode based of the config in the db
if(Settings::get('running_mode')) $running_mode = Settings::get('running_mode');
else $running_mode = 'production';
if($running_mode == 'production'){
	error_reporting(0);
}
else{
	error_reporting(E_ALL);
}


// Check if to include the emergancy header.
if(!file_exists('template/header.php')){
	include('system-views/partials/emergancy-header.php');
}

// Check if the .htaccess file exists, if not, create it.
if(!file_exists('.htaccess')){
	$default_contents = file_get_contents('lib/defaults/.htaccess.default');
	file_put_contents('.htacces', $default_contents) or include('system-views/alerts/htaccess-writable.php');
}

// Check if the header exists and render it
if(file_exists('template/header.php')){
	include('template/header.tpl.php');
}
else{
	include('system-views/alerts/header-exists-error.php');
}

// Check if the website is in maitence mode
if(Settings::get('maintenance')){
	include('system-views/maintence.php');
}
else{
	if(file_exists('template/index.tpl.php')){
		include('template/index.tpl.php');
	}
	else{
		include('system-views/alerts/index-exists-error.php');
	}
}
