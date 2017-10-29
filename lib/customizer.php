<?php

  require_once "bootstrap.php";

  class Customizer {
    /**
      * Function used to get the sections as an array
      * from the database.
      * @return $sections The sections.
    */
    public static function get_sections(){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Theme_Sections");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
      $sections = $query->fetchAll();

      return $sections;
    }

    /**
      * Function used to remove a section
      * from the database.
      * @param $section_name The name of the section.
    */
    public static function remove_section($section_name){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("DELETE FROM Theme_Sections WHERE Name = '$section_name'");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
    }

    /**
      * Function used to check if a section exists
      * @param $section_name The name of the section.
    */
    public static function section_exists($section_name){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Theme_Sections WHERE Name = '$section_name'");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;

      // Check if the section exists
      if(count($result) > 0){
        return true;
      }
      else{
        return false;
      }
    }

    /**
      * Function used to create a new section
      * @return $id The section ID
      * @param $section_name, $section_title
    */
    public static function create_section($section_name, $section_title){
      $db = new Db();
      $db = $db->get();
      try{
        // Check if the section already exists
        $query = $db->prepare("SELECT * FROM Theme_Sections WHERE Name = '$section_name'");
        $query->execute();
        if(!count($query->fetchAll()) > 0){
          $db->exec("INSERT INTO Theme_Sections (Name, Title) VALUES (
            '$section_name',
            '$section_title'
          )");

          // Get the ID of the new section.
          $query = $db->prepare("SELECT * FROM Theme_Sections WHERE Name = '$section_name'");
          $query->execute();
          $result = $query->fetchAll()[0];

          $id = $result['ID'];
          return $id;
        }
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
    }
  }
