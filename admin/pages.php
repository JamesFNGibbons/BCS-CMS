<?php
  /**
    * This page is for creating and deleting
    * pages on the website.
  */

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Get the pages
  $pages = Page::get_pages();
  if($pages !== false){
    $has_pages = true;
  }
  else{
    $has_pages = false;
  }
  
  // Check if the page will be auto added to the nav
  if(Settings::get('navbar-auto-add-pages') == 'true'){
      $nav_auto_add = true;
  }
  else{
      $nav_auto_add = false;
  }

  // Check if we are to delete a page
  if(isset($_GET['delete'])){
    $page_id = $_GET['delete'];
    $page = new Page($page_id);
    if($page->exists){
      $page->delete();
      header('Location: pages.php');
    }
    else{
      die('Error. The page does not exist.');
    }
  }

  // Check if there is a page creation error
  if(isset($_GET['create_error'])){
    $creation_error = true;
  }

  // Check if there is a create page request
  if(
    isset($_POST['title']) &&
    isset($_POST['uri'])
  ){
    $user = new User($_SESSION['username']);
    $author_id = $user->get_id();
    $author_name = $user->get_name();

    $created = Page::create_page(
      $_POST['title'],
      '',
      $_POST['uri'],
      $author_id,
      $author_name
    );

    // Redirect the user to the page editor or display the error.
    if($created !== false){
      header('Location: edit-page.php?id=' . $created);
    }
    else{
      header('Location: pages.php?create_error');
    }
  }
  else{
    include('html/pages.php');
  }
