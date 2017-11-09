<?php

  require_once "bootstrap.php";

  // Load up the default sections.
  global $customizer_sections;
  $customizer_sections = array();

  class Customizer {
    /**
      * Function used to create a new section
      * @return $id The section ID
      * @param $section_name, $section_title
    */
    public static function create_section($section_name, $section_title, $parent = null){
      global $customizer_sections;
      array_push($customizer_sections, array(
        'Name' => $section_name,
        'Title' => $section_title,
        'Parent' => $parent
      ));

      return $section_name;
    }

    /**
      * Function used to update an option value
      * @param $option_name
      * @param $value
    */
    public static function update_option($option_name, $value){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("UPDATE Theme_Options SET Value = '$value' WHERE Name = '$option_name'");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }

    /**
      * Function used to get an options value
      * @param $option_name The options Name
      * @return $value The options value
    */
    public static function get_option_value($option_name){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$option_name'");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      if(count($result) > 0){
        return $result[0]['Value'];
      }
      else{
        return false;
      }
    }

    /**
     * Function used to get the sections.
     * @return $customizer_sections
    */
    public static function get_sections(){
      global $customizer_sections;
      return $customizer_sections;
    }

    /**
      * Function used to get the options associated with
      * a given section.
      * @param $section_name The section name
      * @return $options The array of options.
    */
    public static function get_options($section_name){
      global $option_manager;
      $options = array();

      foreach($option_manager->options as $option){
        if($option['Section'] == $section_name){
          // Get the options value
          $option_name = $option['Name'];

          $db = new Db();
          $db = $db->get();
          try{
            $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$option_name'");
            $query->execute();
            $result = $query->fetchAll();
          }
          catch(PDOException $e){
            die($e->getMessage());
          }

          // Check that the option is valid, and set its value to that from the db.
          if(count($result) > 0){
            $option['Value'] = $result[0]['Value'];
          }
          else die('Invalid option given.');

          // Add the option to the found options.
          array_push($options, $option);
        }
      }

      return $options;
    }
  }
