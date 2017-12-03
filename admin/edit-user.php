<?php

  require_once "../lib/bootstrap.php";
  User::require_login();

  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";

  $updated = isset($_GET['updated']);
  $password_updated = isset($_GET['passwd_updated']);
  $password_unmatch = isset($_GET['passwd_unmatch']);

  /**
    * Redirect the user to the account Settings
    * page if the username is equal to the users
    * username,
  */
  if(isset($_GET['username']) && $_GET['username'] == $_SESSION['username']){
    redirect('account.php?user_edit_redirect');
  }

  /**
    * Check if we need to update the use
    * accounts password.
  */
  if(isset($_POST['action']) && $_POST['action'] == 'update-password'){
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Make sure that the passwords match
    if($password == $_POST['password2']){
      $user = new User($username);
      $user->password = md5($password);
      $user->update();

      redirect("edit-user.php?username=$username&passwd_updated");
    }
    else{
      // Passwords do not match.
      redirect("edit-user.php?username=$username&passwd_unmatch");
    }
  }

  /**
    * Check if we need to delete the user.
  */
  if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    // Make sure that the user is not the loggedin user.
    if($_SESSION['username'] !== $_GET['username']){
      $user = new User($_POST['user']);
      $user->delete();
    }
  }

  /**
    * Check if we need to update the users,
    * details in the database.
  */
  if(isset($_POST['action']) && $_POST['action'] == 'update'){
    $required = array(
      'name',
      'email',
    );
    foreach($required as $require){
      if(empty($_POST[$require])){
        die("Invalid request. $require is not present.");
      }
    }

    $user = new User($_POST['username']);
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->update();

    redirect("edit-user.php?username=$user->username&updated");
  }

  /**
    * Check that the loggedin user is the root
    * user, and has the right to edit the user.
  */
  if(Settings::get('root-user') !== $_SESSION['username']){
    redirect('users.php?access_denied');
  }

  // Check that the username is valid
  if(isset($_GET['username'])){
    // Get the users info.
    $user = new User($_GET['username']);
    if($user->exists){
      // Render the view
      require_once "html/edit-user.php";
    }
    else{
        redirect('users.php?user_invalid');
    }
  }
  else{
    redirect('users.php?user_invalid');
  }
