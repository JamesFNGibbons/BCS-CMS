<?php

  require_once "bootstrap.php";

  /**
    * Function used to sort the items array by the priority.
  */
  function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
  }

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

      // Sort the items based on their priority
      //array_sort_by_column($result, 'priority');
      return $result;
    }

    /**
     * Function used to get the navigation items
     * that have been sorted into a more usable array.
     * @return $items The navigation items array.
    */
    public static function get_nav_items(){
      // Get the navbar items.
      $items = array();
      $child_items = array();

      // Get the parent items.
      foreach(self::get_items() as $item){
        if($item['Parent'] == '0'){
          array_push($items, $item);
        }
        else{
          array_push($child_items, $item);
        }
      }

      // Get the child items, and add them to the parents.\
      foreach($items as $parent){
        // Get the index of the item in the nav items array
        $index = array_search($parent, $items);

        foreach($child_items as $child){
          if(!empty($child['Parent']) && $child['Parent'] == $parent['ID']){
            if($index !== false){
              // Define the sub items array if is null
              if(empty($items[$index]['Sub_Items'])){
                $items[$index]['Sub_Items'] = array();
              }

              // Add the child item to the sub array.
              array_push($items[$index]['Sub_Items'], $child);
            }
          }
        }
      }

      // Return the items.
      return $items;
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
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
      $priority = count($result) + 1;
      //die(var_dump($priority));

      if(isset($title) && isset($link)){
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec("INSERT INTO Nav_Items (Title, Link, Parent, Priority, Type, Page_ID) VALUES (
            '$title',
            '$link',
            '$parent',
            '$priority',
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
    public static function update_item($id, $title, $link, $parent){
      if(isset($id) && isset($title) && isset($link)){
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec("UPDATE Nav_Items SET Title = '$title', Link = '$link', Parent = '$parent' WHERE ID = $id");
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
          $db->exec("UPDATE Nav_Items SET Priority = '$priority' WHERE ID = $item_id");
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
