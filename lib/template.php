<?php
  /**
    * This file is used to give the template function
    * to use, mainly to save time.
  */

  require_once "bootstrap.php";

  /* The current page object */
  if(!isset($the_page)){
    $the_page = null;
  }

  /**
    * Function used to generate the SEO tags
  */
  function the_seo_tags(){
    global $the_page;
    if(isset($the_page)){
      if(!$the_page->is_dummy){
        $seo = $the_page->get_seo_array();
        foreach($seo as $tag){
          $tag_name = $tag['Name'];
          $tag_value = $tag['Value'];

          print "<meta name='$tag_name' value='$tag_value'>";
        }
      }
    }
  }

  /**
    * Function used to get a theme option.
    * @param $option_name The option name
    * @return $value The option value.
  */
  function get_theme_option($option_name){
    $value = Customizer::get_option_value($option_name);
    return $value;
  }

  /**
    * Function used to check if there is
    * a logo set.
    * @return $has_logo If there is a logo.
  */
  function has_logo(){
    if(Settings::get('branding-logo')){
      return true;
    }
    else{
      return false;
    }
  }

  /**
    * Function used to render the logo
    * @param $width The width of the logo
    * @param $height The height of the logo.
  */
  function the_logo($width = '100%', $height = null){
    if(has_logo()){
      $logo_url = Settings::get('branding-logo');
      print "<img src='$logo_url' width='$width' height='$height'>";
    }
  }

  /**
    * Function used to get the logo URL
    * @return $logo_url The logo URL
  */
  function get_logo_url(){
    if(has_logo()){
      $logo_url - Settings::get('branding-logo');
      return $logo_url;
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
    * @return $title;
  */
  function the_site_title(){
    $title = Settings::get('title');
    print $title;
  }

  /**
    * Function used to display the site title
  */
  function the_title(){
    global $the_page;
    if(isset($the_page)){
      print $the_page->title;
    }
  }
