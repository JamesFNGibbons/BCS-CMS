<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  User::require_login();


  // Get the published / unpublished blog posts
  $published_posts = array();
  $unpublished_posts = array();
  foreach(Post::get_posts() as $post){
    if($post['Published'] == 'true'){
      array_push($published_posts, $post);
    }
    else{
      array_push($unpublished_posts, $post);
    }
  }

  if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];
    $post = new Post($post_id);
    $post->delete();

    // Redirect the user back to the blog posts page.
    redirect('blog.php');
  }

  else if(isset($_POST['action'])){
    switch($_POST['action']){
      case('create'):
        $new_post_id = Post::add_post(
          $_POST['title'],
          $_POST['publish'],
          $_POST['uri'],
          $_SESSION['username']
        );

        redirect("edit-post.php?post_id=$new_post_id");
      break;
    }
  }
  else{
    // Render the title
    require_once "html/blog.php";
  }
