<?php

  /**
   * This file is used to cleanup the Customizer options
   * and sections, by deleting the old and unused ones.
  */

  /** DEVELOPMENT HERE HAS BEEN PUT ON HOLD **/

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Load up the themes function.php
  if(file_exists('../template/functions.php')){
    $functions = file_get_contents('../template/functions.php');
  }
  else{
    die('Could not locate the theme functions.');
  }

  // Loop through the theme options in the database.
  foreach(Customizer::get_sections() as $section){
    // Check that the section exists in the functions.php
    if(strpos($functions, $section['Name']) === False){
      // Remove the section, it is not saved in the functions.php file.
      $db = new Db();
      $db = $db->get();
      try{

      }
    }
  }
