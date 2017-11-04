<?php
/**
  * Utility class that contains functions
  * that are only related to the files that
  * have already been uploaded.
*/
class MediaFiles {
  /**
    * Function used to get the files
    * that have been uploaded.
    * @return $files
  */
  public static function get_files(){
    $db = new Db();
    $db = $db->get();
    try{
      $query = $db->prepare("SELECT * FROM Media");
      $query->execute();
      $result = $query->fetchAll();
    }
    catch(PDOException $e){
      die($e->getMessage());
    }
    $db = null;

    return $result;
  }

  /**
    * Function used to get a files name
    * @param $file_path The files path
    * @return $file_name The files name.
  */
  public static function get_shortname($file_path){
    $db = new Db();
    $db = $db->get();
    try{
      $query = $db->prepare("SELECT * FROM Media WHERE File_Path = '$file_path'");
      $query->execute();
      $result = $query->fetchAll();
    }
    catch(PDOException $e){
      die($e->getMessage());
    }
    if(count($result) > 0){
      $file_name = $result[0]['File_Name'];
      return $file_name;
    }
  }

}
