<?php
  /**
    * This page displays the admin users, here
    * they can be added and deleted.
  */

  require_once '../lib/bootstrap.php';
  require_once 'html/partials/header.php';
  require_once 'html/partials/sidebar.php';
  User::require_login();

  // Get the existing users
  $users = User::get_users();
  if($users){
    $has_users = true;
  }
  else{
    $has_users = false;
  }

  // Check if we need to create a new user
  if(
      isset($_POST['username']) &&
      isset($_POST['password']) &&
      isset($_POST['email']) &&
      isset($_POST['name'])
  ){
    // Check if the Email or Username is in use.
    $verification = User::email_or_username_in_use($_POST['email'], $_POST['username']);
    if($verification == 'email'){
      $email_in_use_error = true;
    }
    else if($verification == 'username'){
      $username_in_use_error = true;
    }

    if(!$verification){
      // Create the new user
      User::create_user(
        $_POST['name'],
        $_POST['email'],
        $_POST['username'],
        $_POST['password']
      );
      // Reload the page
      redirect('users.php');
    }
  }

  // Render the view
  require_once 'html/users.php';
