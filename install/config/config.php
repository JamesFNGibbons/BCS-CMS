<?php
  require_once "../lib/bootstrap.php";

  if(file_exists('../config/config.php')){
    require_once('../config/config.php');
  } else die('Config file could not be found');
