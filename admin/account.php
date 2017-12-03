<?php

    require_once "../lib/bootstrap.php";
    require_once "html/partials/header.php";
    require_once "html/partials/sidebar.php";
    User::require_login();

    // Get the users information.
    $user = new User($_SESSION['username']);

    // Check if the account password / info has been updated
    $password_updated = isset($_GET['password-saved']);
    $account_updated = isset($_GET['changes-saved']);
    $password_error = isset($_GET['password-error']);
    $user_edit_redirect = isset($_GET['user_edit_redirect']);

    // Check if there is an action to be completed.
    if(isset($_POST['action'])){
        switch($_POST['action']){
            case('update-password'):
              // Check that the two passwords are the same.
              if($_POST['password'] == $_POST['password2']){
                $password = md5($_POST['password']);
                $user->password = $password;
                $user->update();

                redirect('account.php?password-saved');
              }
              else{
                // Display the error.
                redirect('account.php?password-error');
              }
            break;
            case('update'):
              $user->name = $_POST['name'];
              $user->email = $_POST['email'];
              $user->update();

              redirect('account.php?changes-saved');
            break;
            default:
              die("Invalid action posted.");
        }
    }
    else{
        // Render the view
        require_once 'html/account.php';
    }
