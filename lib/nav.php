<?php

  require_once "bootstrap.php";

  class Nav {
    /**
      * Function used to get the navigation
      * items from the database.
      * @return $result The navigation items found.
    */
    public static function get_items(){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Nav_Items");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;

      return $result;
    }

    /**
      * Function used to add a new nav item
      * @param $title The item title
      * @param $link The item link
      * @param $parent The parent item.
    */
    public static function add_item($type_array, $title, $link, $parent){
      if(isset($type_array["Type"])){
        $type = $type_array["Type"];
        if($type = 'page'){
          $page_id = $type_array['Page_ID'];
        }
        else{
          $page_id = '';
        }
      }

      // Calculate the priotiry
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Nav_Items");
        $query->fetchAll();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
      $priority = count($result);
      $priotiry += 1;

      if(isset($title) && isset($link)){
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec("INSERT INTO Nav_Items (Title, Link, Parent, Priority, Type, Page_ID) VALUES (
            '$title',
            '$link',
            '$parent',
            $priotiry,
            '$type',
            '$page_id'
          )");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        $db = null;
      }
    }

    /**
      * Function used to update an item
      * @param $title, The Title
      * @param $link, The link
      * @param $ID, The ID of the item.
    */
    public static function update_item($id, $title, $link){
      if(isset($id) && isset($title) && isset($link)){
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec("UPDATE Nav_Items SET Title = '$title', Link = '$link' WHERE ID = $id");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        $db = null;
      }
    }

    /**
      * Function used to update the priotiry of a
      * navigation item.
      * @param $id The ID of the nav item
      * @param $priority The new priority of the nav item.
    */
    public static function set_item_priority($item_id, $priority){
      if(isset($item_id) && isset($priority)){
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec("UPDATE Nav_Items SET Priority = $priotiry WHERE ID = $item_id");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        $db = null;
      }
    }

    /**
      * Function used to delete a nav item.
      * @param $id The ID of the item.
    */
    public static function remove_item($id){
      if(isset($id)){
        $db = new Db();
        $db = $db->get();

        // Get the item and check if it has any sub items.
        try{
          $query = $db->prepare("SELECT * FROM Nav_Items WHERE ID = $id");
          $query->execute();
          $result = $query->fetchAll();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        if(count($result) > 0){
          if(isset($result[0]['Sub_Items'])){
            // Delete the sub items.
            $subItems = $result[0]['Sub_Items'];
            foreach($subItems as $item){
              $itemId = $item['ID'];
              try{
                $db->exec("DELETE FROM Nav_Items WHERE ID = $itemId");
              }
              catch(PDOException $e){
                die($e->getMessage());
              }
            }
          }
        }

        // Remove the item (as a parent) from the database.
        try{
          $db->exec("DELETE FROM Nav_Items WHERE ID = $id");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
    }
  }
