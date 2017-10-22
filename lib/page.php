<?php
  /**
    * This class is used to handle the pages
    * on the website.
  */

  require_once "bootstrap.php";

  class Page {
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
    public static function create_page($title, $content, $author_id, $author_name){
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
          if(count($query->fetchAll()) > 0){
            return $query[0]['ID'];
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
