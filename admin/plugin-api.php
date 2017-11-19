<?php

require_once "../lib/bootstrap.php";

if(isset($_GET['api'])){
  if(isset($_GET['plugin'])){
    // Check that the plugin is loaded.
    if($plugin_manager->is_loaded($_GET['plugin'])){
      // Check that the Api() function exists in the plugin,
      // And then forward the request to the plugins Api() function.
      if(method_exists($plugin_manager->get_plugin($_GET['plugin']), 'Api')){
        $data = $plugin_manager->get_plugin($_GET['plugin'])->Api($_GET['api']);
        print $data;
      }
      else{
        die('The plugin has no API function.');
      }
    }
  }
  else {
    die('Invalid plugin.');
  }
}
else{
  redirect('index.php');
}
