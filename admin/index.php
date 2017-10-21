<?php
  /**
    * This will either display the homepage
    * or the login page depending on the users
    * login status.
  */

  require_once "../lib/bootstrap.php";
  require_once 'html/partials/header.php';

  // Check if the user is loggedin
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

  }
  else{
    // Check if there is a login request
    if(isset($_POST['username']) && isset($_POST['password'])){
      $user = new User($_POST['username'], $_POST['password']);
      if($user->login_is_valid){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user->get_username();
        header('Location: index.php');
      }
      else{
        $login_error = true;
      }
    }
    else{
      // render the login page
      include('html/login.php');
    }
  }
