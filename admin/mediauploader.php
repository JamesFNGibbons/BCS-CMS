<?php

  require_once "../lib/bootstrap.php";
  User::require_login();

  if(isset($_POST['return']) && isset($_FILES['new_file'])){
    $return = $_POST['return'];
    $the_file = $_FILES['new_file'];
    $param = $_POST['param'];
    $name = $the_file['name'];

    // Upload the new file
    $upload = Media::upload_file($the_file, $name, true);
    if(!empty($upload)){
      redirect("$return?selected_media=$upload&$param");
      exit;
    }
  }
  else {
    die('Could not upload file.');
  }
