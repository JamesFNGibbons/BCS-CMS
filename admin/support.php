<?php

    require_once "../lib/bootstrap.php";
    User::require_login();
    
    require_once "html/partials/header.php";
    require_once "html/partials/sidebar.php";
    
    // Get the users site information.
    $user = new User($_SESSION['username']);
    $name = $user->name;
    $url = Settings::get('url');
    
    // Check if we need to create a new support request
    if(isset($_POST['action']) && $_POST['action'] == 'create'){
        
    }
    else{
        require_once "html/create-support-request.php";
    }