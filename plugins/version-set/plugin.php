<?php
    class Version_Set implements Plugin{
        public function Run(){
            // Create the admin menue link
            add_admin_sidebar_action_item(
              array(
                "Title" => 'Version Setter',
                "Icon" => 'fa fa-code-fork',
                "Action_ID" => 'version-set',
                "Action" => array($this, 'admin_view')
              )
            );
        }

        public function admin_view(){
            // Check if the user has saved the new version.
            if(isset($_POST['new_version'])){
              Settings::set('software_version', $_POST['new_version']);
              $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              header("Location: $url");
            }
            else{
              include "admin-view.php";  
            }
        }
    }
