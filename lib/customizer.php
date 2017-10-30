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
    public static function create_section($section_name, $section_title){
      global $customizer_sections;
      array_push($customizer_sections, array(
        'Name' => $section_name,
        'Title' => $section_title
      ));
    }
    
    /**
     * Function used to get the sections.
     * @return $customizer_sections
    */
    public static function get_sections(){
      global $customizer_sections;
      return $customizer_sections;
    }
  }
