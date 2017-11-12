<?php
  class Contact_Plugin implements Plugin {
    public function Run(){
        // Create the admin menue link.
        add_admin_sidebar_action_item(
          array(
            "Title" => 'Contact Requests',
            "Icon" => 'fa fa-phone',
            "Action_ID" => 'contact',
            "Action" => array($this, 'admin_view')
         )
       );

       // Create the table to store the contact requests
       $table = new Table('Contact_Requests');
       $table->add_column("Name", "text");
       $table->add_column("Email", 'text');
       $table->add_column("Phone", 'text');
       $table->add_column("Website", 'text');
       $table->create();
    }

    /**
      * Function called when the admin item is clicked.
      * This function is used to render the view in the
      * admin interface.
    */
    public function admin_view(){
      // Check if the user wants to delete a request.
      if(isset($_GET['delete'])){
       $db = new Db();
       $db = $db->get();
       try{
        $db->exec("DELETE FROM Contact_Requests WHERE ID = $id");
       }
       catch(PDOException $e){
           die($e->getMessage());
       }
       $db = null;

       // Redirect the user.
       header('Location: index.php');
      }
      else{
        require_once "html/requests.php";
      }
    }
  }
