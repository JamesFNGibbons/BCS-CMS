<?php
  /**
    * This file is used to give the template function
    * to use, mainly to save time.
  */

  require_once "bootstrap.php";

  /* The current page object */
  if(!isset($the_page)) $the_page = null;

  /**
    * Function used to generate the SEO tags
  */
  function the_seo_tags(){
    global $the_page;
    if(isset($the_page)){
      $seo = $the_page->get_seo_array();
      foreach($seo as $tag){
        $tag_name = $tag['Name'];
        $tag_value = $tag['Value'];

        print "<meta name='$tag_name' value='$tag_value'>";
      }
    }
  }

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
  function the_title(){
    print Settings::get('title');
  }
