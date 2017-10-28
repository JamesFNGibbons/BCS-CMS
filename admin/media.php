<?php

  require_once "../lib/bootstrap.php";
  require_once "../lib/media.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Get the files stored in the database.
  $files = Media::get_files();

  // Check if we need to delete a file
  if(isset($_POST['action']) && $_POST['action'] == 'delete'){
    Media::delete_file($_POST['file_id']);
    header('Location: media.php');
  }

  // Check if we need to upload a file
  if(isset($_FILES['to_upload'])){
    // Upload the new file using the Media API
    $upload = Media::upload_file($_FILES['to_upload'], $_POST['shortname']);
    if($upload){
      // Check if a return path was sent
      if(isset($_POST['return'])){
        $return = $_POST['return'];
        header("Location: $return");
      }
      else{
        header('Location: media.php');
      }
    }
    else{
      print "Your file could not be uploaded. The filetype may be banned.";
      print "<br> <a href='index.php'>Back</a>";
    }
  }
  else{
    // Render the view
    include('html/media.php');
  }
