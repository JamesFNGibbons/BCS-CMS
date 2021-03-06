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
      * Function used to get the plugin class.
      * @return $the_plugin The plugin instance.
      * @param $plugin_name The name of the plugin.
    */
    public static function get_plugin($plugin_name){
      if(self::is_loaded($plugin_name)){
        global $plugin_manager;
        $the_plugin = null;

        // Loop through the active plugins, and check if it is active.
        foreach($plugin_manager->active_plugins as $plugin){
          if($plugin['Info']->Name == $plugin_name){
            $the_plugin = $plugin['Plugin'];
          }
        }

        if(empty($the_plugin)){
          die("Could not locate the plugin instance for `$plugin_name`");
        }
        else{
          return $the_plugin;
        }
      }
      else{
        die("Cannot load plugin `$plugin_name`, as it is not loaded.");
      }
    }

    /**
      * Function used to check if a plugin has
      * been loaded OK.
      * @param $plugin_name
      * @return $loaded
    */
    public static function is_loaded($plugin_name){
      global $plugin_manager;
      $loaded = true;
      foreach($plugin_manager->active_plugins as $plugin){
        if($plugin['Info']->Name == $plugin_name){
          $loaded = true;
        }
      }

      return $loaded;
    }

    /**
      * Function used to load and activate the plugins.
    */
    public function load_plugins(){
      // Load correct plugin directory
      if(count(glob('../plugins/*')) > 0){
        $plugin_dir = '../plugins/*';
      }
      else if(count(glob('plugins/*'))){
        $plugin_dir = 'plugins/*';
      }

      // Loop through the files in the plugin directory
      foreach(glob($plugin_dir) as $file){
        if(is_dir($file)){
          // Remove the astricks from the plugin dir.
          $plugin_dir = str_replace('*', '', $plugin_dir);
          $filename = basename($file);

          // Check if the plugin.php file exists;
          if(file_exists($plugin_dir .$filename . "/plugin.php")){
            if(file_exists($plugin_dir ."$filename/plugin.json")){
              // Get the main plugin className
              $pluginInfo = file_get_contents($plugin_dir ."$filename/plugin.json");
              $pluginInfo = json_decode($pluginInfo);
              $class_name = $pluginInfo->Main_Class;

              require_once $plugin_dir .$filename . "/plugin.php";

              $plugin = new $class_name();
              if($plugin instanceof Plugin){
                // Push the plugin into the active_plugins array
                array_push($this->active_plugins, array(
                  "Info" => $pluginInfo,
                  "Plugin" => $plugin,
                  "Loaded" => Time()
                ));

                // Run the plugin
                $plugin->plugin_dir = $plugin_dir.$filename."/";
                $plugin->Run();
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
