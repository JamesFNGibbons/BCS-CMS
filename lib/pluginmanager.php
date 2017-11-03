<?php

  class PluginManager {
    
    /**
     * Define the two arrays that will contain the 
     * plugins that have been processed.
    */
    public $active_plugins;
    public $error_plugins;

    /**
      * Constructor used to set the default values
    */
    public function __construct(){
      $this->active_plugins = array();
      $this->error_plugins = array();
    }

    /**
      * Function used to load and activate the plugins.
    */
    public function load_plugins(){
      // Loop through the files in the plugin directory
      foreach(glob('../plugins/*') as $file){
        if(is_dir($file)){
          $filename = basename($file);

          // Check if the plugin.php file exists;
          if(file_exists('../plugins/' .$filename . "/plugin.php")){
            if(file_exists("../plugins/$filename/plugin.json")){
              // Get the main plugin className
              $pluginInfo = file_get_contents("../plugins/$filename/plugin.json");
              $pluginInfo = json_decode($pluginInfo);
              $class_name = $pluginInfo->Main_Class;

              require '../plugins/' .$filename . "/plugin.php";

              $plugin = new $class_name();
              if($plugin instanceof Plugin){
                // Push the plugin into the active_plugins array
                array_push($this->active_plugins, array(
                  "Info" => $pluginInfo,
                  "Plugin" => $plugin,
                  "Loaded" => Time()
                ));
              }
              else{
                array_push($this->error_plugins, array(
                  'Name' => $pluginInfo->Name,
                  'Problem' => "The plugin class '$plugin_info->Main_Class' does not extent 'Plugin'"
                ));
              }
            }
            else{
              array_push($this->error_plugins, array(
                'Name' => "/$filename",
                'Problem' => 'The plugin.json file does not exist within the plugin directory.'
              ));
            }
          }
          else{
            array_push($this->error_plugins, array(
              'Name' => "/$filename",
              'Problem' => 'The plugin.php file does not exist within the plugin directory.'
            ));
          }
        }
      }
    }
  }
