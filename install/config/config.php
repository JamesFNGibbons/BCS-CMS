<?php
  require_once "../lib/bootstrap.php";

  // This is an alias for the main config file.
  if(Install::is_complete()){
    if(file_exists('../config/config.php')){
      require_once('../config/config.php');
    } else die('Config file could not be found');
  }
