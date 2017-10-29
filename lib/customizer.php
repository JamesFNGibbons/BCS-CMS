<?php
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
  }
