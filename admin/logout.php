<?php
 /**
   * Used to logout the user from the admin panel.
 */

 require_once '../lib/bootstrap.php';

 if(is_loggedin()){
   $_SESSION['username'] = null;
   $_SESSION['loggedin'] = false;
   header('Location: index.php');
 }
