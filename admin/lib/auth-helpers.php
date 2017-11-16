<?php
  /**
    * These are just standalone authentication
    * helpers to be used accross the program.
  */

  require_once "bootstrap.php";

  /**
    * Function used to redirect the user to the
    * login page if they are not loggein.
  */
  function require_login(){
    if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']){
      header('Location: index.php');
    }
  }

  /**
    * Function to check if the user is loggedin
  */
  function is_loggedin(){
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
      return true;
    }
    else{
      return false;
    }
  }
