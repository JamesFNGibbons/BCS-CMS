<?php
  /**
    * This class is used to handle the pages
    * on the website.
  */

  require_once "bootstrap.php";

  class Page {
    public $title;
    public $content;
    public $author_name;
    public $author_id;
    public $created;
    public $uri;
    public $updated;
    public $id;

    /**
      * Constructor used to get the data of the
      * page from the database.
      * @param $id The ID of the page.
    */
    public function __construct($id){
      if(isset($id)){
        $db = new Db();
        $db = $db->get();

        try{
          $query->prepare("SELECT * FROM Pages WHERE ID = '$id'");
          $query->execute();
          $result = $query->fetchAll();
          if(count($result) > 0){
            $result = $result[0];
            $this->title = $result['Title'];
            $this->content = $result['Content'];
            $this->author_name = $result['Author_Name'];
            $this->author_id = $result['Author_ID'];
            $this->created = $result['Created'];
            $this->uri = $result['URI'];
            $this->updated = $result['Updated'];
            $this->id = $id;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
    }

    /**
      * Function used to create a new page.
      * @param $title The page title
      * @param $content The page content (HTML)
      * @param $uri The page URI
      * @param $author_id The author ID
      * @param $author_name The Author Name
      * @return false if the uri was in use.
      * @return the ID of the new page, if the page was created.
    */
    public static function create_page($title, $content, $uri, $author_id, $author_name){
        $db = new Db();
        $db = $db->get();

        // Check if the uri is not already in use.
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE URI = '$uri'");
          $query->execute();
          if(count($query->fetchAll()) > 0){
            return false;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }

        // Create the new page in the database.
        try{
          $db->exec("INSERT INTO Pages (Title, Content, Created, Updated, Author_ID, Author_Name, URI) VALUES
          (
            '$title',
            '$content',
            now(),
            now(),
            '$author_id',
            '$author_name',
            '$uri'
          )");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }

        // Get the ID of the new page
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE URI = '$uri'");
          $query->execute();
          $result = $query->fetchAll();
          if(count($result) > 0){
            return $result[0]['ID'];
          }
          else{
            return false;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
    }

    /**
      * Function used to get the pages in the database.
      * @return $pages The pages in an array.
      * @return false If no pages are in the database.
    */
    public static function get_pages(){
      $db = new Db();
      $db = $db->get();

      try{
        $query = $db->prepare("SELECT * FROM Pages");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      $result = $query->fetchAll();
      if(count($result) > 0){
        return $result;
      }
      else{
        return false;
      }
    }
  }
