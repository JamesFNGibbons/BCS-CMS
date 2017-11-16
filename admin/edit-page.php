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

    // Update the pages feature image if it is selected.
    if(isset($_GET['selected_media'])){
      $page->feature_image = $_GET['selected_media'];
      $page->update();
      $id = $_GET['id'];
      header("Location: edit-page.php?id=$id");
    }
    else {
      include("html/modals/select-media.php");
    }

    // Load up the possible page templates
    $templates = array();
    foreach(glob("../template/*") as $file){
      if(!is_dir($file)){
        // Check if the file is a template
        $file = explode('../template/', $file)[1];
        if(substr($file, 0, 8) == 'template'){
            $template_name_file = explode('template-', $file)[1];
            $template_name = explode('.php', $template_name_file)[0];
            array_push($templates, $template_name);
        }
      }
   }

    // Check if there is any custom page templates.
    if(count($templates) > 0) $has_templates = true;
    else $has_templates = false;

    // Check if there is a valid feature image
    if(empty($page->feature_image)){
      $no_feature_image = true;
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
      $page->template = $_POST['template'];
      $page->subtitle = $_POST['subtitle'];
      $page->update();

      header("Location: edit-page.php?id=$page->id");
    }
    else{
      header('Location: index.php');
    }
  }
