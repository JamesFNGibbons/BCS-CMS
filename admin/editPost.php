<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  if(isset($_GET['post_id'])){
    global $post;
    $post = new Post($_GET['post_id']);
  }

  if(isset($_POST['action']) && $_POST['action'] == 'update'){

  }
  else{
    // Render the view
    require_once "html/edit-post.php";
  }
