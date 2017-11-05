<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Get the allowed file types from the database.
  $file_types = array();
  foreach(Settings::get_all() as $setting){
    if(substr($setting['Key_Name'], 0, 14) == 'allow-filetype'){
      array_push($file_types, $setting);
    }
  }

  // Check if we need to update any of the settings.
  if(isset($_POST['action']) && $_POST['action'] = 'update'){
    // Check if all the required setting keys are present.
    $required = array(
      'title',
      'subtitle',
      'logo'
    );
    foreach($required as $require){
      if(empty($_POST[$require])) die('Setting KEY ' . $required . 'Not Present');
    }

    // Check and update the logo
    if(!$_POST['logo'] == 'No Image Selected'){
      Settings::set('branding-logo', $_POST['Logo_Name']);
    }

    // Update the database.
    foreach($required as $require){
      Settings::set($require, $_POST[$require]);
    }

    // Redirect the user back to the settings page
    header('Location: setting.php');
  }
  else{
    // Check if any logo is selected
    if(Settings::get('branding-logo')){
      $logo = MediaFiles::get_shortname(Settings::get('branding-logo'));
    }
    else{
      $logo = 'No Image Selected';
    }

    // Render the settings view
    include('html/setting.php');

    // Check if a new logo has been selected
    if(isset($_GET['selected_media'])){
      $logo = $_GET['selected_media'];
      Settings::set('branding-logo', $logo);
      header('Location: setting.php');
    }

    $select_media_action = 'setting.php';
    include("html/modals/select-media.php");

  }
