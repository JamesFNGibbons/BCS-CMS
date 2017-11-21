<?php

    require_once "../lib/bootstrap.php";
    require_once "html/partials/header.php";
    require_once "html/partials/sidebar.php";
    User::require_login();

    /**
    * Check if there is an action item clicked.
    */
    if(isset($_GET['action_id'])){
      global $admin_sidebar_items;

      // Check that the action exists
      $action_id = $_GET['action_id'];
      $exists = false;
      $item = null;

      foreach($admin_sidebar_items as $item){
        if(isset($item['Action_ID'])){
          $action = $item['Action_ID'];
          if($action_id == $action){
            call_user_func($item['Action']);
          }
        }
      }
    }
