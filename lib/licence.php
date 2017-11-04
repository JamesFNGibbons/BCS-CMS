<?php

  require_once "bootstrap.php";

	/**
		* Defines the connection URL to our servers.
		* The software will not work without this.
	*/
	define("BCS_LM_URL", "http://localhost/cms-lm/");

  class Licence {
    /**
      * Function used to check if we need to
      * update the software.
    */
    public static function needs_update(){
      $current_version = Settings::get('software_version');
      $version = file_get_contents(BCS_LM_URL . 'current_version.php');

      if($version == $current_version){
        return false;
      }
      else {
        return $version;
      }
    }

    /**
      * Function used to get the new version
      * update zip.
    */
    public static function get_update(){
      $version = file_get_contents(BCS_LM_URL . 'current_version.php');
      return file_get_contents(BCS_LM_URL . "update/$version.zip");
    }

    /**
      * Function used to check if a key exists.
      * @param $key The key in questionl
      * @return $exists
    */
    public static function key_exists($key){
      $fields = array(
        "key" => $key
      );
      $ping = curl_init();
      curl_setopt($ping, CURLOPT_URL, BCS_LM_URL . 'do_check.php');
      curl_setopt($ping, CURLOPT_POST, count($fields));
      curl_setopt($ping, CURLOPT_POSTFIELDS, $fields);
      curl_setopt($ping, CURLOPT_RETURNTRANSFER, true);

      // Run the ping.
      $result = curl_exec($ping);
      curl_close($ping);

      // Check for a CURL error
      if($result === False){
        die(curl_error($ping));
      }

      if(empty($result)) return false;
      $result = json_decode($result);
      return $result->Exists;
    }

    /**
      * Function to check if this is the default
      * domain name on file.
      * @return $is_default.
    */
    public static function is_domain(){
      $domain = Settings::get('url');

      // Ping the licence server to validate the domain.
      $fields = array(
        "key" => md5(Settings::get('key')),
        "domain" => Settings::get('url')
      );
      //url-ify the data for the POST
      foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
      rtrim($fields_string, '&');

      $req = curl_init();
      curl_setopt($req, CURLOPT_URL, BCS_LM_URL . "do_domain_check.php");
    }
  }
