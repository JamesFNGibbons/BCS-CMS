<?php
  /**
    * This is the updater. It will update the core system,
    * but will leave the plugins, config and theme alone.
    * It can also be used to update the database.
  */

  require_once '../lib/bootstrap.php';
  require_login();

  /**
    * Function used to get the base URL from
    * of the server.
    * @return The URL
  */
  function getBaseUrl(){
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
    // return: http://localhost/myproject/
    $url = $protocol.'://'.$hostName.$pathInfo['dirname']."/";
    return str_replace('admin/', '', $url);
  }

  // Update the website URL
  Settings::set('url', getBaseUrl());

  // Run all the models in the models directory.
  $db = new Db();
  $db = $db->get();
  foreach(glob('../models/*') as $file){
    if(!is_dir($file)){
      try{
        $filename = basename($file);
        $sql = file_get_contents('../models/' . $filename);
        $db->exec($sql);
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }
  }
  $db = null;

  // Get the current software version
  Settings::set('software_version', '1.2.2');

  // Update the last_updated value in the database.
  $dt = new DateTime('now');
  $date = $dt->format('Y-m-d H:i:s');
  Settings::set('last_updated', $date);

  // Update the .htaccess file from the default.
  $htaccess_contents = file_get_contents('../lib/defaults/.htaccess.default');
  file_put_contents('../.htaccess', $htaccess_contents);

  // Redirect back to the homepage.
  header('Location: index.php');
