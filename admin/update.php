<?php
  /**
    * This is the updater. It will update the core system,
    * but will leave the plugins, config and theme alone.
    * It can also be used to update the database.
  */

  require_once '../lib/bootstrap.php';
  require_login();

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

  // Redirect back to the homepage.
  header('Location: index.php');
