<?php
  /**
    * This file is used to give the template function
    * to use, mainly to save time.
  */

  require_once "bootstrap.php";

  /* The current page object */
  $page = null;

  /**
    * Function used to get the site title
    * @return The site title;
  */
  function get_site_title(){
    return Settings::get('title');
  }

  /**
    * Function used to display the site title
  */
  function site_title(){
    print Settings::get('title');
  }
