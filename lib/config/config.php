<?php
  // This is an alias for the main config file.
  if(file_exists('../config/config.php')){
    require_once('../config/config.php');
  } else die('Config file could not be found.');
