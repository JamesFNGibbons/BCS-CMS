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
        // Get the contact requests from the table.
        $table = new Table('Contact_Requests');
        $requests = $table->fetch_all();

        require_once "html/requests.php";
      }
    }
    
    /**
      * Function used when the contact request form is submitted.
    */
    public function handle_submit(){
        $required = array();
        foreach($required as $require){
            if(!isset($_POST[$require])){
                die("Invalid Request. $require is not posted.");
            }
        }   
        
        // Localise the submitted form data.
        $name = $_POST['name'];
        $email = $POST['email'];
        $phone = $_POST['phone'];
        $website = $_POST['website'];
        $message = $_POST['message'];

        // Add the new contact request to the database.
        $db = new Db();
        $db = $db->get();
        try{
            $db->exec("INSERT INTO Contact_Requests (Name, Email, Phone, Website, Message) VALUES (
                '$name',
                '$email',
                '$phone',
                '$website',
                '$message'
            )");
        }
        catch(PDOException $e){
            die($e->getMessage());
        }

        // Complete. Redirect the user back to the inital page.
        if(isset($this->redirect_url)){
            header("Location: $this->redirect_url");
        }
        else{
            // No redirect URL, take the user back to the homepage.
            header("Location: index.php");
        }
    }

    /**
      * Function used to rener the contact form itself.
    */
    public function get_form(){
        // Check if the form has been submitted.
        if(isset($_POST['action']) && $_POST['action'] == 'submit'){
            $this->handle_submit();
        }
        else{
            require_once "html/contact-form.php";
        }
    }
  }
