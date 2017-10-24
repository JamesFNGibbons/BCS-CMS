<?php
  /**
    * This will either display the homepage
    * or the login page depending on the users
    * login status.
  */

  require_once "../lib/bootstrap.php";
  require_once 'html/partials/header.php';

  $last_updated = Settings::get('last_updated');
  $software_version = Settings::get('software_version');

  // Check if the user is loggedin
  if(is_loggedin()){
    /**
      * Gets the recent blog posts from the
      * bespoke computer software website, and
      * puts them into an array to be displayed.
    */
    ini_set("allow_url_fopen", 1);
    $wp_bcs_posts = file_get_contents('http://bespokecomputersoftware.co.uk/wp-json/wp/v2/posts');
    $recent_news = json_decode($wp_bcs_posts, true);

    // Load up the users data
    $user = new User($_SESSION['username']);
    include('html/partials/sidebar.php');
    include('html/home.php');
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
