<?php
  /**
    * This is the updater. It will update the core system,
    * but will leave the plugins, config and theme alone.
    * It can also be used to update the database.
  */

  require_once '../lib/bootstrap.php';
  require_login();

  /**
    * Check if the version of the software
  */
  if(Licence::needs_update() !== false){
    $new_version = Licence::needs_update();

    // Create a folder for the new version to be stored in.
    if(!file_exists('../dist/update')) mkdir('../dist/update');
    if(!file_exists('../dist/update/' . $new_version)){
      mkdir('../dist/update/' . $new_version);
    }
    // Download the new version from the server.
    file_put_contents("../dist/update/$new_version/core.zip", Licence::get_update());

    $zip = new ZipArchive;
    if($zip->open("../dist/update/$new_version/core.zip") === TRUE) {
        $zip->extractTo('../');
        $zip->close();

        // Update the database to say the latest version.
        Settings::set('software_version', $new_version);
        
        // Delete the update zip file to save space
        unlink("../dist/update/$new_version/core.zip");

    } else {
        die('Update has failed.');
    }
  }

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

  // Run all the single excutables in the models directory.
  $db = new Db();
  $db = $db->get();
  foreach(glob('../models/run-once/*') as $file){
    if(!is_dir($file)){
      try{
        $filename = basename($file);
        $sql = file_get_contents('../models/run-once/' . $filename);
        $db->exec($sql);
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Delete the single run file after
      unlink('../models/run-once/' . $filename);
    }
  }
  $db = null;

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

  // Add the new filetype uploads to the database.
  $file_types = array(
    'jpg',
    'jpeg',
    'mp4',
    'mp3',
    'png',
    'gif',
    'svg',
    'pdf',
    'psd'
  );
  foreach($file_types as $type){
    // Set there default value if they are not already defined.
    if(!Settings::get('allow-filetype-' . $type)){
      Settings::set('allow-filetype-' . $type, 'true');
    }
  }

  // Redirect back to the homepage.
  header('Location: index.php');
