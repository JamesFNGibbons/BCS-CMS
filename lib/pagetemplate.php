<?php

  class PageTemplate {
    /**
      * Function used to get the correct template for a given page.
      * @param $page_id The ID of the page.
    */
    public static function get_template($page_id){
      if(isset($page_id)){
        $page = new Page($page_id);
        $template = $page->template;

        // Check that the page template is not a default template.
        if(empty($template)){
          // The template file is default.
          if(@file_exists("../template/page.php")){
            require_once "../template/page.php";
          }
          else{
            die("The page template does not exist. <br> <a href='index.php'>Go Back</a>");
          }
        }
        else{
          // Check that the page template exists
          if(@file_exists("../tempate/template-$template.php")){
            require_once "../template/templae-$template.php";
          }
          else{
            die("The page template '$template' does not exist. <br> <a href='index.php'>Go Back</a>");
          }
        }
      }
    }
  }
