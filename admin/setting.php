<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  User::require_login();

  // Check if the website features have been disabled.
  $disable_site = false;
  if(Settings::get('site-disabled') == 'true'){
    $disable_site = true;
  }

  // Check if we need to update any of the settings.
  if(isset($_POST['action']) && $_POST['action'] = 'update'){
    // Check if all the required setting keys are present.
    $required = array(
      'title',
      'subtitle',
      'url',
      'disable-website'
    );
    foreach($required as $require){
      if(empty($_POST[$require])) die('Setting KEY ' . $require . 'Not Present');
    }

    // Update the database.
    foreach($required as $require){
      Settings::set($require, $_POST[$require]);
    }

    // Redirect the user back to the settings page
    redirect('setting.php');
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
      redirect('setting.php');
    }

    $select_media_action = 'setting.php';
    include("html/modals/select-media.php");

  }
