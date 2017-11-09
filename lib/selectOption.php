<?php

  require_once "bootstrap.php";

  class SelectOption {
    /**
      * Function used to get an options select options.
      * @return $options The options.
      * @param $option_id The Customizer option ID
    */
    public static function get_options($option_name){
      // Check that the customizer option with the option_id is a select type.
      $options = array();

      global $option_manager;
      foreach($option_manager->options as $option){
        if($option['Type'] == 'select' && $option['Name'] == $option_name){
          if(isset($option['Options'])){
            $options = $option['Options'];
          }
        }
      }

      return $options;
    }
  }
