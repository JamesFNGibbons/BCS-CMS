<?php

  class WidgetManager {

    public $widgets;

    /**
      * Constructor used to setup the widget manager
    */
    public function __construct(){
      $this->widgets = array();
    }

    /**
      * Function used to register a widget.
      * @param $widget The widget array.
    */
    public function register_widget($widget){
      if($this->type_exists($widget['Type'])){
        array_push($this->widgets, $widget);
      }
      else{
        die("Cannot register invalid widget type.");
      }
    }

    /**
      * Function used to check if a widget type is valid.
      * @param $widgetType The widget type.
    */
    public static function type_exists($type){
      if(isset($type)){
        if(file_exists("widgets/$type") && is_dir("widgets/$type")){
          if(file_exists("widgets/widget.php")){
            return true;
          }
          else{
            return false;
          }
        }
        else{
          return false;
        }
      }
      else{
        return false;
      }
    }

  }
