<?php
  /**
    * This class is used to handle the pages
    * on the website.
    * @class Page
  */

  require_once "bootstrap.php";

  class Page {
    public $title;
    public $content;
    public $author_name;
    public $author_id;
    public $created;
    public $uri;
    public $updated;
    public $id;
    public $exists;
    public $is_homepage;
    public $is_dummy = false;
    public $feature_image;

    /**
      * Constructor used to get the data of the
      * page from the database.
      * @param $id The ID of the page.
    */
    public function __construct($id){
      if(isset($id)){
        $db = new Db();
        $db = $db->get();

        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE ID = $id");
          $query->execute();
          $result = $query->fetchAll();
          if(count($result) > 0){
            // Check if the page is the homepage
            if($id == Settings::get('homepage-page')){
              $this->is_homepage = true;
            }
            else{
              $this->is_homepage = false;
            }

            $result = $result[0];
            $this->title = $result['Title'];
            $this->content = $result['Content'];
            $this->author_name = $result['Author_Name'];
            $this->author_id = $result['Author_ID'];
            $this->created = $result['Created'];
            $this->uri = $result['URI'];
            $this->updated = $result['Updated'];
            $this->id = $id;
            $this->exists = true;
            $this->feature_image = $result['Feature_Image'];
          }
          else{
            $this->exists = false;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
    }

    /**
      * Function used to get the homepage object
      * @return $page The homepage instance.
    */
    public static function get_homepage(){
      // Check if the homepage has been defined.
      if(Settings::get('homepage-page')){
        $page = new Page(Settings::get('homepage-page'));
      }
      else{
        // No homepage. Use a placeholder.
        $page = new Page(null);
        $page->title = 'Default Page';
        $page->content = 'Please select a homepage in the admin portal';
        $page->is_dummy = true;
        $page->is_homepage = true;
        $page->exists = true;
      }

      return $page;
    }

    /**
      * Function used to get the pages SEO
      * data from the database.
      * @return $seo
      * @return false if nothing was found.
    */
    public function get_seo_array(){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Page_SEO WHERE Page_ID = '$this->id'");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Check if any SEO data was found
      if(count($result) > 0){
        $seo = $result;
        return $seo;
      }
      else{
        return false;
      }
    }

    /**
      * Function used to set the SEO of a page
      * @param $key_name The SEO key name
      * @param $value The new value
    */
    public function set_seo($key_name, $value){
      $db = new Db();
      $db = $db->get();
      $id = $this->id;

      // Check if the key already exists
      try{
        $query = $db->prepare("SELECT * FROM Page_SEO WHERE Name = '$key_name' and Page_ID = $id");
        $query->execute();
        $result = $query->fetchAll();

        if(count($result) > 0){
          // update the existing value
          $db->exec("UPDATE Page_SEO WHERE Name = '$key_name' AND Page_ID = $id SET Value = '$value'; ");
        }
        else{
          // Add the value.
          $db->exec("INSERT INTO Page_SEO (Name, Value, Page_ID) VALUES (
            '$key_name',
            '$value',
            '$id'
          )");
        }
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }

    /**
      * Function used to delete the page.
    */
    public function delete(){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("DELETE FROM Pages WHERE ID = $this->id");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Delete the pages SEO from the Page_SEO table.
      try{
        $db->exec("DELETE FROM Page_SEO WHERE Page_ID = $this->id");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }

    /**
      * Function used to get the pages SEO
      * @param $key_name
      * @return $value
      * @return False if nothing was found.
    */
    public function get_seo($key_name){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Page_SEO WHERE Page_ID = $this->id AND Name = '$key_name'");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;

      // Check if anuthing was found.
      $result = $query->fetchAll();
      if(!count($result) > 0){
        return false;
      }
      else{
        $value = $result[0]['Value'];
        return $value;
      }
    }

    /**
      * Function used to get the page ID from the URI
      * @param $uri The URI of the requested page
      * @return $id The ID of the page
      * @return null If the page was not found.
    */
    public static function get_id_from_uri($uri){
      if(isset($uri)){
        $db = new Db();
        $db = $db->get();
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE URI = '$uri'");
          $query->execute();
          $result = $query->fetchAll();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        $db = null;

        // Check if the page exists
        if(count($result) > 0){
          return $result[0]['ID'];
        }
        else{
          return null;
        }
      }
    }

    /**
      * Function used to get the page ID from title
      * @param $title The page title
      * @return $id The ID
      * @return null If the page does not exist.
    */
    public static function get_id($title){
      if(isset($title)){
        $db = new Db();
        $db = $db->get();
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE Title = '$title'");
          $query->execute();
          $result = $query->fetchAll();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        $db = null;

        // Check if the page exists
        if(count($result) > 0){
          return $result[0]['ID'];
        }
        else{
          return null;
        }
      }
    }
  
    /**
     * Function used to update the page in the database.
     * with the changed values.
    */
    public function update(){
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("UPDATE Pages SET Title = '$this->title', Content = '$this->content', Updated = now()
        WHERE ID = '$this->id'; ");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
    }
  
    /**
      * Function used to create a new page.
      * @param $title The page title
      * @param $content The page content (HTML)
      * @param $uri The page URI
      * @param $author_id The author ID
      * @param $author_name The Author Name
      * @return false if the uri was in use.
      * @return the ID of the new page, if the page was created.
    */
    public static function create_page($title, $content, $uri, $author_id, $author_name){
        $db = new Db();
        $db = $db->get();

        // Check if the uri is not already in use.
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE URI = '$uri'");
          $query->execute();
          if(count($query->fetchAll()) > 0){
            return false;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }

        // Create the new page in the database.
        try{
          $db->exec("INSERT INTO Pages (Title, Content, Created, Updated, Author_ID, Author_Name, URI, Feature_Image) VALUES
          (
            '$title',
            '$content',
            now(),
            now(),
            '$author_id',
            '$author_name',
            '$uri',
            ''
          )");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }

        // Get the ID of the new page
        try{
          $query = $db->prepare("SELECT * FROM Pages WHERE URI = '$uri'");
          $query->execute();
          $result = $query->fetchAll();
          if(count($result) > 0){
            $id = $result[0]['ID'];
          }
          else{
            return false;
          }
        }
        catch(PDOException $e){
          die($e->getMessage());
        }

        // Set the default SEO tags of the page
        $title = Settings::get('title');
        $page = new Page($id);
        $page->set_seo('title', $page->title);
        $page->set_seo('description', "$page->title - $title");
        $page->set_seo('keywords', '');
        $page->set_seo('og:type', 'article');
        $page->set_seo('og:title', $page->title);
        $page->set_seo('og:description', '');
        $page->set_seo('og:url', $page->uri);
        $page->set_seo('og:site_name', Settings::get('title'));
        $page->set_seo('article:publisher', Settings::get('url'));
        $page->set_seo('og:image', '');
        $page->set_seo('og:image:width', '310');
        $page->set_seo('og:image:height', '310');

        // Return the page ID
        return $id;
    }

    /**
      * Function used to get the pages in the database.
      * @return $pages The pages in an array.
      * @return false If no pages are in the database.
    */
    public static function get_pages(){
      $db = new Db();
      $db = $db->get();

      try{
        $query = $db->prepare("SELECT * FROM Pages");
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      $result = $query->fetchAll();
      if(count($result) > 0){
        return $result;
      }
      else{
        return false;
      }
    }
  }
