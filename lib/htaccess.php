<?php

    /**
      * This class is used to manage the .htacces file
      * and create it if it does not exist.
    */
    class Htaccess {
        /**
          * Function used to check if the htaccess file exists.
          * @return $exists If the file exists.
        */
        public static function exists(){
            $exists = @file_exists('../.htaccess');
        }

        /**
          * Function used to create the htaccess file, using the
          * default located in the defaults folder.
        */
        public static function create_root(){
            // Check that the directory is writable.
            if(is_writable('../')){
                // Check that the default file exists and get the content.
                if(@file_exists('defaults/htaccess.default')){
                    $the_content = file_get_contents('defaults/htaccess.default');
                }
                else{
                    $the_content = '#There was no default htaccess file to base this on.';
                }

                // Write the content to the new .htaccess file.
                file_put_contents('../.htaccess', $the_content);
            }
            else{
                die("Could not write to the root directory.");
            }
        }

        /**
          * Function used to delete the .htaccess file
        */
        public static function delete_root(){
            if(@file_exists('../.htaccess')){
                unlink('../.htaccess');
            }
        }

        /**
          * Function used to get the contents of the htaccess file.
        */
        public static function get_root_contents(){
            if(file_exists('../.htaccess')){
                $the_contents = file_get_contents('../.htaccess');
                return $the_contents;
            }
        }
    }
