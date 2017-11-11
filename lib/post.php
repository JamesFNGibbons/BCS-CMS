<?php

  require_once "bootstrap.php";

  class Post {
    public $title;
    public $published;
    public $content;
    public $feature_image;
    public $creator;
    public $id;

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
        $this->id = $post_id;
      }
      $db = null;
    }

    /**
      * Function used to update the post in the
      * database.
    */
    public function update(){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("UPDATE Blog_Posts SET Title = '$this->title', Content = '$this->content', Feature_Image = '$this->feature_image'");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }

    /**
      * Function used to delete the post from the database.
    */
    public function delete(){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("DELETE FROM Blog_Posts WHERE ID = $this->id");
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
    public static function add_post($title, $published, $creator){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("INSERT INTO Blog_Posts (Title, Published, Creator) VALUES (
          '$title',
          '$published',
          '$creator'
        )");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Get the post ID
      try{
        $query = $db->prepare("SELECT * FROM Blog_Posts WHERE Title = '$title'");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      if(count($result) > 0){
        $post_id = $result[0]['ID'];
        return $post_id;
      }
      else{
        die('Invalid Post Title');
      }
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

    /**
      * Function used to render the blog view and post
      * template.
      * @param $post_uri The post ID.
    */

  }
