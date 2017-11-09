<?php

  require_once "bootstrap.php";

  class OptionManager {
    public $options = array();

    /**
      * Function used to register a new option.
    */
    public function register_option($option){
      if(empty($option)){
        die('Cannot register an option with null.');
      }

      array_push($this->options, $option);
    }
  }
