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
        if(!empty($seo)){
          foreach($seo as $tag){
            $tag_name = $tag['Name'];
            $tag_value = $tag['Value'];

            print "<meta name='$tag_name' value='$tag_value'>";
          }
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
    * Function used to get the feature image of a page.
  */
  function the_feature_image(){
    global $the_page;
    if(isset($the_page)){
      print $the_page->feature_image;
    }
  }

  /**
    * Function used to display the page subtitle.
  */
  function the_subtitle(){
    global $the_page;
    if(isset($the_page)){
      print $the_page->subtitle;
    }
  }

  /**
    * Function used to display the page title
  */
  function the_title(){
    global $the_page;
    if(isset($the_page)){
      print $the_page->title;
    }
  }

  /**
   * Function used to display the pages content
   * @return $the_page->content The page content.
  */
  function the_content(){
    global $the_page;
    if(isset($the_page)){
      print $the_page->content;
    }
  }

  /**
    * Function used to return the latest post.
    * @return $post
  */
  function get_latest_post(){
    $post = Post::get_latest_post();
    return $post;
  }

  /**
    * Function used to check if there are any posts.
    * @return $have_posts;
  */
  function has_posts(){
    if(count(Post::get_posts()) > 0){
      return true;
    }
    else{
      return false;
    }

    return $have_posts;
  }

  /**
    * Alias function to allow wp themes to work.
  */
  function have_posts(){
    return has_posts();
  }

  /**
    * Function used to get the posts.
    * @return $the_posts
  */
  function get_posts(){
    if(have_posts()){
      $the_posts = Post::get_posts();
      return $the_posts;
    }
    else{
      return array();
    }
  }

  /**
    * Function used to get the pages.
    * @return $the_pages
  */
  function get_pages($limit = 0){
    $the_pages = Page::get_pages($limit);
    return $the_pages;
  }

  /**
   * Function used to render the navigation items for a bootstrap navbar.
  */
  function the_bootstrap_nav($open_tag = '<ul class="nav navbar-nav">', $close_tag = "</ul>"){
    global $the_page;

    // Render the container open tag.
    print $open_tag;

    $nav_items = Nav::get_nav_items();
    foreach($nav_items as $item){
      // Do not render the item if it has a parent
      if(empty($item['Parent']) && empty($item['Sub_Items'])){
        // Check if the navbar item should be active
        print "<li>";

        // Render the link tag.
        $link = $item['Link'];
        print "<a href='$link '>";
        print $item['Title'];
        print "</a>";

        // Close the tag
        print "</li>";
      }

      else if(isset($item['Sub_Items'])){
       ?>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href='<?php print $item["Link"]; ?>'><?php print $item['Title']; ?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach($item['Sub_Items'] as $sub_item): ?>
              <li>
                <a href='<?php print $sub_item["Link"]; ?>'>
                  <?php print $sub_item["Title"]; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php
      }
    }

    // Render the container closing tag.
    print $close_tag;
  }
