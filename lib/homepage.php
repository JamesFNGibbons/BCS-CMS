<?php

  require_once "bootstrap.php";

  class Homepage {
    /**
      * Function used to check if we should display
      * a specific section on the homepage. It uses the
      * Settings API to do this.
      * @param $section The section ID
      * @return $display Boolean
    */
    public static function display($section){
      if(isset($section)){
        $display = Settings::get("display-homepage-section-$section");
        if($display == 'true'){
          $display = true;
        }
        else{
          $display = false;
        }

        return $display;
      }
    }
  }
