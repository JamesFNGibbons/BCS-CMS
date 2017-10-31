<?php
  /**
    * This is the main page editor. It allows
    * the used to edit the content of the page
    * and change its fearure image.
  */

  require_once '../lib/bootstrap.php';
  require_once 'html/partials/header.php';
  require_once 'html/partials/sidebar.php';
  require_login();

  // Check if the page is valid and get the data.
  if(isset($_GET['id'])){
    $page = new Page($_GET['id']);
    
    // Load the media selector for the feature image.
    $select_media_action = 'edit-page.php';
    $select_media_param = 'id=' . $_GET['id'];
    include("html/modals/select-media.php");
    
    // Update the pages feature image if it is selected.
    if(isset($_GET['selected_media'])){
      $page->feature_image = $_GET['selected_media'];
      $page->update();
    }
    
    // Render the view
    include('html/edit-page.php');
  }
  else{
    // Check if there is an update request.
    if(isset($_POST['action']) && $_POST['action'] == 'update'){
      $page = new Page($_POST['id']);
      $page->title = $_POST['title'];
      $page->content = $_POST['content'];
      $page->update();
      
      header("Location: edit-page.php?id=$page->id");
    }
    else{
      header('Location: index.php'); 
    }
  }