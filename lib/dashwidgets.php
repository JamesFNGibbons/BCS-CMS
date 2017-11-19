<?php

  /** Define the Dashboard widgets array if empty. */
  global $dash_widgets;
  if(!isset($dash_widgets)){
    $dash_widgets = array();
  }

  /**
    * Function used to create a new dashboard widget.
    * @param $widget The new widget stored in the array.
  */
  function add_dash_widget($widget){
    if(!empty($widget) && isset($widget['Title']) && isset($widget['Action'])){
      global $dash_widgets;
      array_push($dash_widgets, $widget);
    }
  }

  /**
    * Function used to display the dash widgets.
    * They will be displayed in bootstrap panels.
  */
  function the_dash_widgets(){
    global $dash_widgets;
    if(!empty($dash_widgets)){
      foreach($dash_widgets as $widget){
        ?>
          <div class='panel panel-default'>
            <div class='panel-heading'><?php print $widget['Title']; ?></div>
            <div class='panel-body'><?php call_user_func($widget['Action']); ?></div>
          </div>
        <?Php
      }
    }
  }
