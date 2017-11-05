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
	header('Location: install?step=1');
}

// Check if a page is requested
if(isset($_GET['page'])){
	$page_id = Page::get_id_from_uri($_GET['page']);
	$the_page = new Page($page_id);
}
else{
	$the_page = Page::get_homepage();
}

// Render the page header
include_once "lib/template.php";
include "template/header.php";

// Check if we need to render the homepage view
if($the_page->is_homepage){
	include "template/index.php";
}
else{
	include "template/page.php";
}
