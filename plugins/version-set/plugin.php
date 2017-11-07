<?php
    class Version_Set implements Plugin{
        public function Run(){
            // Create the admin menue link
            add_admin_sidebar_action_item(
                array(
                    "Title" => 'Version Setter',
                    "Icon" => 'fa fa-code-fork'
                ),
                array($this, 'admin_view')
            );
        }
        
        public function admin_view(){
            print "Hello world";
        }
    }