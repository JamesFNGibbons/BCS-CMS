<?php

  /**
    * Class used to handle the media uploads
    * from the records in the database, to the
    * files stored on the hard drive.
  */

  require_once "bootstrap.php";

  /**
    * Function used to check if a given directory
    * is empty.
  */
  function is_dir_empty($dir) {
    if (!is_readable($dir)) return NULL;
    return (count(scandir($dir)) == 2);
  }

  class Media {
    /**
      * Function used to get uploaded files from
      * the database.
      * @return $files The array of files.
    */
    public static function get_files(){
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare('SELECT * FROM Media');
        $query->execute();
        $files = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      return $files;
    }

    /**
      * Function used to delete a file.
      * @param $file_id The ID of the file to delete.
    */
    public static function delete_file($file_id){
      // Get the files path from the database.
      $db = new Db();
      $db = $db->get();
      try{
        $query = $db->prepare("SELECT * FROM Media WHERE ID = $file_id");
        $query->execute();
        $result = $query->fetchAll();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }

      // Check that the file ID is valid.
      if(count($result) > 0){
        global $file;
        $file = $result[0];
      }
      else{
        die("Could not delete the file. Invalid ID.");
      }

      // Change the file path to suit the /lib directory
      $file['File_Path'] = '../' . $file['File_Path'];

      // Remove the file itself, and directory if it is now empty.
      unlink($file['File_Path']);
      $directory = explode($file['File_Name'], $file['File_Path'])[0];
      if(is_dir_empty($directory)){
        rmdir($directory);
      }

      // Remove the files record from the database.
      try{
        $db->exec("DELETE FROM Media WHERE ID = $file_id");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;
    }

    /**
      * Function used to upload media to
      * the system.
      * @param $file The file to upload
      * @param $return_path If true, return the path of the new file.
      * @return false The upload was blocked.
    */
    public static function upload_file($file, $return_path = false){
      // Check if the filetype is allowed
      $filetype = explode('.', $file['name'])[1];
      if(Settings::get("allow-filetype-$filetype") !== 'true'){
        return false;
      }

      // Check that the uploads folder is writable
      if(!is_writable('../uploads')){
        die("Could not upload file. The Uploads folder is not writable.");
      }

      // Create an uploads folder for this day if not exists
      $dir_date = date('d').'-'.date('m').'-'.date('y');
      if(!file_exists('../uploads/'.$dir_date)){
        global $dirname;
        $dirname = "uploads/$dir_date";
        mkdir("../$dirname");
      }

      // Rename the file and move it to the /uploads dir.
      $file_name = uniqid();
      $file_name .= '.';
      $file_name .= $filetype;
      $file_path = "uploads/$dir_date/$file_name";
      move_uploaded_file($file['tmp_name'], "../$file_path");

      // The uploaders username
      $username = $_SESSION['username'];

      // Record the file in the database.
      $db = new Db();
      $db = $db->get();
      try{
        $db->exec("INSERT INTO Media (File_Name, File_Path, Uploader, Upload_Date)
        VALUES (
          '$file_name',
          '$file_path',
          '$username',
          now()
        )");
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      $db = null;

      // Check what we need to return
      if($return_path){
        return $file_path;
      }
      else{
        return true;
      }
    }
  }
