<?php
  /**
    * This will either display the homepage
    * or the login page depending on the users
    * login status.
  */

  require_once "../lib/bootstrap.php";
  require_once 'html/partials/header.php';

  // Get the software versions from the database.
  $last_updated = Settings::get('last_updated');
  $software_version = Settings::get('software_version');

  // Check if the user is loggedin
  if(is_loggedin()){
    // Check if a forced update is required
    if(Settings::get('force-update') == 'true'){
      redirect('update.php');
    }

    // Check if the version has recently been updated
    if(Settings::get('version-change') == 'true'){
      $version_change = true;
      Settings::set('version-change', 'false');
    }
    else{
      $version_change = false;
    }

    // defines the warnings array
    $warnings = array();

    // Check if the .htaccess on the frontend is writable
    if(!is_writable('../.htaccess')) array_push($warnings, ".htaccess file is not writable.");
    if(!file_exists('../template/header.tpl.php')) array_push($warnings, "The theme does not have a header file.");
    if(!file_exists('../template/footer.tpl.php')) array_push($warnings, "The theme does not have a footer file.");
    if(!file_exists('../template/index.tpl.php')) array_push($warnings, "The theme does not have a homepage template.");
    if(!file_exists('../template/page.tpl.php')) array_push($warnings, "The theme does not have a page template.");

    // Do not display the warnings alert.
    $has_warings = false;

    /**
      * Gets the recent blog posts from the
      * bespoke computer software website, and
      * puts them into an array to be displayed.
    */
    ini_set("allow_url_fopen", 1);
    $wp_bcs_posts = file_get_contents('http://bespokecomputersoftware.co.uk/wp-json/wp/v2/posts');
    $recent_news = json_decode($wp_bcs_posts, true);

    // Checks if there is a version splash landing page
    if(file_exists('../lib/version/splash.php')){
      include('../lib/version/splash.php');
    }

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
        redirect('index.php');
      }
      else{
        $login_error = true;
        // Re-render the login page
        include('html/login.php');
      }
    }
    else{
      // render the login page
      include('html/login.php');
    }
  }
