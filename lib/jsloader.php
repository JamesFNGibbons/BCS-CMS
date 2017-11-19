<?php

  /**
    * This is used to allow plugins to load JS into the
    * admin panel of the website, as they are loaded.
  */

  global $js_items;
  if(!isset($js_items)){
    $js_items = array();
  }

  /**
    * Function used to load as JS file.
    * @param $the_file The path to the file.
  */
  function add_js($the_file, $plugin){
    // Get the directory to load the js from.
    if(isset($plugin) && !empty($plugin->plugin_dir)){
      $dir = $plugin->plugin_dir;
      $the_file = $dir . $the_file;
    }

    if(isset($the_file)){
      global $js_items;
      array_push($js_items, $the_file);
    }
  }

  /**
    * Function used to load an external JS file.
    * @param $url The link to the external file.
  */
  function add_external_js($url){
    if(isset($url)){
      global $js_items;
      array_push($js_items, $url);
    }
  }

  /**
    * Function used to get the loaded js files, and render them.
  */
  function the_plugin_js(){
    global $js_items;
    if(!empty($js_items)){
      foreach($js_items as $item){
        ?>
          <script src='<?php print $item; ?>'></script>
        <?php
      }
    }
  }
