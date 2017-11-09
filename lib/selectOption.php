<?php

  require_once "bootstrap.php";

  class SelectOption {
    /**
      * Function used to get an options select options.
      * @return $options The options.
      * @param $option_id The Customizer option ID
    */
    public static function get_options($option_id){
      // Check that the customizer option with the option_id is a select type.
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Theme_Options WHERE ID = $option_id");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      if(count($result) > 0){
        $option = $result[0];
        if($option['Type'] == 'select'){
          // Get the options for the selector.
          try{
            $query = $db->prepare("SELECT * FROM Select_Options WHERE Option_ID = $option_id");
            $query->execute();
            $result = $query->fetchAll();
          }
          catch(PDOException $e){
            die($e->getMessage());
          }

          // return the options
          $options = $result;
          return $options;
        }
        else{
          die("The option type is not a selector.");
        }
      }
      else{
        die("Invalid Option ID");
      }
    }
  }
