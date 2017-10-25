<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Get the last time the homepage was updats
  $last_updated = Settings::get('homepage-last-updated');
  if(empty($last_updated)){
    $last_updated = 'Never Updated';
  }

  // Check if we need to update any settings
  if(isset($_POST['action']) && $_POST['action'] == 'update'){
    // The required url params
    $required = array(
      'top-banner'
    );
    // The values submitted
    $values = array();

    // Loop through the required and check they are set
    foreach($required as $require){
      if(!empty($_POST[$require])){
        $value = $_POST[$require];
      }
      else{
        $value = 'false';
      }

      // Add the value to the array.
      array_push($values, array(
        "name" => $require,
        "value" => $_POST[$require]
      ));
    }

    // Update the values in the database.
    foreach($values as $value){
      $value_name = $value['name'];
      $value_value = $value['value'];

      // Fix the NULL pointer
      if(empty($value_value)){
        $value_value = 'false';
      }

      Settings::set("display-homepage-section-$value_name", $value_value);
      Settings::set("homepage-last-updated", date());
      header('Location: homepage-settings.php');
    }
  }
  else{
    // Check if we should display the top banner
    $display_top_banner = Homepage::display('top-banner');

    // Render the view
    include "html/homepage-settings.php";
  }
