<?php

  require_once "bootstrap.php";

  class Post {
    public $title;
    public $published;
    public $content;
    public $feature_image;
    public $creator;

    /**
      * Constructor used to load up the post
      * information, from its ID.
      * @param $post_id
    */
    public function __construct($post_id){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Blog_Posts WHERE ID = '$post_id'");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      if(count($result) > 0){
        $post = $result[0];
        $this->title = $post['Title'];
        $this->published = $post['Published'];
        $this->content = $post['Content'];
        $this->feature_image = $post['Feature_Image'];
        $this->creator = $post['Creator'];
      }
      $db = null;
    }

    /**
      * Function used to delete the post from the database.
    */
    public function delete(){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("DELETE FROM Posts WHERE ID = $post_id");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }

    /**
      * Function used to create a new post.
      * @param $title The post title.
      * @param $published The published status.
      * @return $post_id The new post ID.
    */
    public static function add_post($title, $published){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("INSERT INTO Blog_Posts (Title, Published) VALUES (
          '$title',
          '$published'
        )");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Get the post ID
      try{
        $query = $db->prepare("SELECT * FROM Blog_Posts WHERE Title = '$title'");
        $query->fetchAll();
        $result = $query->fetchAll();
        $post_id = $result[0]['ID'];
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      return $post_id;
    }

    /**
      * Function used to get all the blog posts from the
      * database.
      * @return $posts
    */
    public static function get_posts(){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Blog_Posts");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      $posts = $result;
      return $posts;
    }
  }
