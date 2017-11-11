<?php

  require_once "../../lib/bootstrap.php";

  class TextareaWidget implements Widget {

    public $title;
    public $content;

    /**
      * Function called when the widget is registered.
    */
    public function onRegister($widget){
      if(!empty($widget['Attributes'])){
        $attributes = $widget['Attributes'];
      }
    }

    /**
      * Function used to load the database.
    */
    public function loadDatabase(){
      $table = new Table('Textarea_Widgets');
      $table->add_column('Title', 'text');
      $table->add_column('Content', 'text');
      $table->add_column('WidgetName', 'text');
      $table->create();
    }
  }
