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
  }
  else{
    header('Location: index.php');
  }
