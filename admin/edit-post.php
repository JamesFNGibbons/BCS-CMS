<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  User::require_login();

  // Check if a page feature image has been selected.
  if(isset($_GET['selected_media'])){
    $post = new Post($_GET['post_id']);
    $post->feature_image = $_GET['selected_media'];
    $post->update();

    // Reload the post editor.
    redirect("edit-post.php?post_id=$post->id");
  }

  if(isset($_POST['action']) && $_POST['action'] == 'update'){
    $post = new Post($_POST['post_id']);
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->update();

    redirect('blog.php');
  }
  else{
    if(isset($_GET['post_id'])){
      // Setup the image selector
      $select_media_action = "edit-post.php";
      $select_media_param = "post_id=$post->id";
      require_once "html/modals/select-media.php";

      // Render the view.
      $post = new Post($_GET['post_id']);
      require_once "html/edit-post.php";
    }
    else{
      redirect('blog.php?no_id_given');
    }
  }
