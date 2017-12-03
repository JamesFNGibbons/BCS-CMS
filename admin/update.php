<?php
  /**
    * This is the updater. It will update the core system,
    * but will leave the plugins, config and theme alone.
    * It can also be used to update the database.
  */

  require_once '../lib/bootstrap.php';
  User::require_login();

  // Set the default software version if not set
  if(!Settings::get('software_version')){
    Settings::set('software_version', $_software_version);
  }

  /**
    * Add the root user to the database,
    * if there is none.
  */
  if(Settings::get('root-user') == false){
    if(!empty($_SESSION['username'])){
      Settings::set('root-user', $_SESSION['username']);
    }
  }

  /**
	  * Setup the default error reporting, if
		* it has not already been set.
	*/
	if(Install::is_complete()){
		if(!Settings::get('error-reporting')){
      Settings::set('error-reporting', 'true');
    }
	}

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

    // Use the os specific command to download the new version file.
    switch(strtoupper(PHP_OS)){
      case('DARWIN'):
        $cmd = "curl -o ../dist/update/$new_version/core.zip http://wm-lm-s1.bespokecomputersoftware.com/update/$new_version/core.zip";
      break;
      case('LINUX'):
        $cmd = "curl -o ../dist/update/$new_version/core.zip http://wm-lm-s1.bespokecomputersoftware.com/update/$new_version/core.zip";
      break;
    }
    if(isset($cmd)){
      exec($cmd);
    }

    // Extract the new core.zip update using native commands.
    $_os = strtoupper(PHP_OS);
    if($_os == 'DARWIN' or $_os == 'LINUX'){
      exec("unzip ../dist/update/$new_version/core.zip -d ../");
    }

    // Update the database to say the latest version, and then delete the core.zip file.
    Settings::set('software_version', $new_version);
    $version_change = true;
    unlink("../dist/update/$new_version/core.zip");
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
  redirect('index.php');
