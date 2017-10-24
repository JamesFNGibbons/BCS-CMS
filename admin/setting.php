<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Check if we need to update any of the settings.
  if(isset($_POST['action']) && $_POST['action'] = 'update'){
    // Check if all the required setting keys are present.
    $required = array(
      'title',
      'subtitle',
    );
    foreach($required as $require){
      if(empty($_POST[$require])) die('Setting KEY ' . $required . 'Not Present');
    }

    // Update the database.
    foreach($required as $require){
      Settings::set($require, $_POST[$require]);
    }

    // Redirect the user back to the settings page
    header('Location: setting.php');
  }
  else{
    // Render the settings view
    include('html/setting.php');
  }
