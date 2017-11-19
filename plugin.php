<?php

  class Order_Tracker implements Plugin {
    /**
      * Called on the plugin startup.
    */
    public function Run(){
      // Create the menu item.
      add_admin_sidebar_action_item(
        array(
          "Title" => 'Device Repairs Manager',
          "Icon" => 'fa fa-wrench',
          "Action_ID" => 'devrepairs',
          "Action" => array($this, 'admin_view')
       )
     );

     // Create the overview widget on the dashboard home.
     add_dash_widget(array(
        'Title' => 'Device Repairs Overview',
        'Action' => array($this, 'overview_dash_widget')
     ));

     // Create the table to store the customers.
     $user_table = new Table('DR_Customers');
     $user_table->add_column('Name', 'text');
     $user_table->add_column('Email', 'text');
     $user_table->add_column('Phone', 'text');
     $user_table->create();
     $this->customers_table = $user_table;

     // Create the table to store the devices.
     $active_orders = new Table('DR_Active_Orders');
     $active_orders->add_column('Customer', 'int');
     $active_orders->add_column('Make', 'text');
     $active_orders->add_column('Model', 'text');
     $active_orders->add_column('Item_Desc', 'text');
     $active_orders->add_column('Serial_No', 'text');
     $active_orders->add_column('Password', 'text');
     $active_orders->add_column('Job_Desc', 'text');
     $active_orders->add_column('Price_Quoted', 'text');
     $active_orders->add_column('Created', 'date');
     $active_orders->create();
     $this->active_orders_table = $active_orders;

     // Create the table to store the past orders.
     $past_orders = new Table('DR_Past_Orders');
     $past_orders->add_column('Customer', 'int');
     $past_orders->add_column('Make', 'text');
     $past_orders->add_column('Model', 'text');
     $past_orders->add_column('Item_Desc', 'text');
     $past_orders->add_column('Serial_No', 'text');
     $past_orders->add_column('Password', 'text');
     $past_orders->add_column('Job_Desc', 'text');
     $past_orders->add_column('Price_Quoted', 'text');
     $past_orders->add_column('Created', 'date');
     $past_orders->add_column('Completed', 'date');
     $past_orders->create();
     $this->active_orders_table = $past_orders;

     // Create the table to store the devices.
     $devices = new Table('DR_Devices');
     $devices->add_column('Make', 'text');
     $devices->add_column('Model', 'text');
     $devices->create();
     $this->devices_table = $devices;

     // Add the javascript files of the plugin.
     add_js('js/angular.min.js', $this);
     add_js('js/app.js', $this);
     add_js('js/overview.js', $this);
     add_js('js/home.js', $this);
     add_js('js/add-order.js', $this);
     add_js('js/view-customer.js', $this);

     // Add the google charts libary.
     add_external_js('https://www.gstatic.com/charts/loader.js');
    }

    /**
      * Function called when the dashboard overview widget is loaded.
    */
    public function overview_dash_widget(){
      // Render the view
      require_once "html/widgets/overview.php";
    }

    /**
      * Function used to handle an API request.
      * @param $request The request type ID.
    */
    public function Api($request){
      if(isset($request)){
        switch($request){
          /**
            * Function used to get the active orders from the db.
          */
          case('get-active-orders'):
            $db = new Db();
            $db = $db->get();
            try{
              $query = $db->prepare("SELECT * FROM DR_Active_Orders");
              $query->execute();
              $active_orders = $query->fetchAll();
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            return json_encode($active_orders);
          break; 

          /**
            * Function used to add the order to the database.
          */
          case('add-order'):
            $order = json_decode($_GET['order']);

            $serial = $order->device->serial;
            $make = $order->device->make;
            $model = $order->device->model;
            $passcode = $order->device->passcode;
            $description = $order->device->description;
            $price_quoted = $order->device->price_quoted;

            // Add the new order to the database.
            $db = new Db();
            $db = $db->get();
            try{
              $db->exec("INSERT INTO DR_Active_Orders (
                Customer,
                Serial_No,
                Make,
                Model,
                Password,
                Job_Desc,
                Price_Quoted,
                Created
              ) VALUES (
                '$order->customer',
                '$serial',
                '$make',
                '$model',
                '$passcode',
                '$description',
                '$price_quoted',
                now()
              );");
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            return '1';
          break;

          /**
            * Function used to add a devices make and model to the database.
          */
          case('add-device'):
            $make = strtolower($_GET['make']);
            $model = strtolower($_GET['model']);

            // Check if we need to add the make and model
            $db = new Db();
            $db = $db->get();
            try{
              $query = $db->prepare("SELECT * FROM DR_Devices WHERE Make = '$make' and Model = '$model'");
              $query->execute();
              $result = $query->fetchAll();

              if(count($result) > 0){
                $db->exec("INSERT INTO DR_Devices (Make, Model) VALUES (
                  '$make',
                  '$model'
                );");
              }
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            return '1';
          break;

          /**
            * Function used to add a customer to the database.
            * and return the ID.
          */
          case('add-customer'):
            $name = $_GET['name'];
            $email = $_GET['email'];
            $phone = $_GET['phone'];

            // Check that the email is not already used.
            $db = new Db();
            $db = $db->get();
            try{
              $query = $db->prepare("SELECT * FROM DR_Customers WHERE Email = '$email'");
              $query->execute();
              $result = $query->fetchAll();
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            if(count($result) > 0){
              return "Email-Used";
            }
            
            // Add the new customer to the database.
            try{
              $db->exec("INSERT INTO DR_Customers (Name, Email, Phone) VALUES (
                  '$name',
                  '$email',
                  '$phone'
              );");
            }
            catch(PDOException $e){
              die($e->getMessage());
            }
            $db = null;

            // Tell angular that the customer has been added.
            return "1";
          break;

          /**
            * Returns the customers stored in the database.
          */
          case('get-customers'):
            $customers = $this->customers_table->fetch_all();
            return json_encode($customers);
          break;

          /**
            * Returns the number of customers stored in the database.
          */
          case('count-customers'):
            $customers = $this->customers_table->fetch_all();
            return count($customers);
          break;

          /**
            * Used to get the customers orders.
          */
          case('get_customer_orders'):
            if(isset($_GET['type'])){
              $type = $_GET['type'];
            }
            else{
              $type = 'active';
            }
            $customer = $_GET['customer'];

            $db = new Db();
            $db = $db->get();
            try{
              if($type == 'active'){
                $query = $db->prepare("SELECT * FROM DR_Active_Orders WHERE Customer = $customer");
              }
              else{
                $query = $db->prepare("SELECT * FROM DR_Past_Orders WHERE Customer = $customer");
              }
              $query->execute();
              $result = $query->fetchAll();
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            return json_encode($resuslt);
          break;

          /**
            * Used to delete a customer from the database.
          */
          case('delete_customer'):
            if(isset($_GET['id'])){
              $id = $_GET['id'];
              $db = new Db();
              $db = $db->get();
              try{
                $db->exec("DELETE FROM DR_Customers WHERE ID = $id");
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              redirect("plugin-view.php?action_id=devrepairs&customer_deleted");
            }
          break;
          default:
            die('Invalid request.');
        }
      }
    }

    /**
      * Function called when the plugin admin view is requested.
    */
    public function admin_view(){
      if(isset($_GET['p'])){
        switch($_GET['p']){
          case('save_order'):
            // Make sure all the params are sent.
            $required = array(
              "id",
              "make",
              "model",
              "serial_no",
              "password",
              "job_desc",
              "price_quoted"
            );
            foreach($required as $require){
              if(!isset($_GET[$require])){
                die("Error $require is not sent.");
              }
            }

            $id = $_GET['id'];
            $make = $_GET['make'];
            $model = $_GET['model'];
            $serial_no = $_GET['serial_no'];
            $password = $_GET['password'];
            $job_desc = $_GET['job_desc'];
            $price_quoted = $_GET['price_quoted'];

            // Update the values in the database.
            $db = new Db();
            $db = $db->get();
            try{
              $db->exec("UPDATE DR_Active_Orders SET
                Make = '$make',
                Model = '$model',
                Serial_No = '$serial_no',
                Password = '$password',
                Job_Desc = '$job_desc',
                Price_Quoted = '$price_quoted'
              WHERE ID = $id;");
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            // Redirect the user
            redirect('plugin-view.php?action_id=devrepairs');
          break;

          case('complete_order'):
            $order_id = $_GET['id'];
            $db = new Db();
            $db = $db->get();
            try{
              // Get the order info.
              $query = $db->prepare("SELECT * FROM DR_Active_Orders WHERE ID = $order_id");
              $query->execute();
              $result = $query->fetchAll();

              if(count($result) > 0){
                // Get the old order.
                $order = $result[0];
                $customer = $order['Customer'];
                $make = $order['Make'];
                $model = $order['Model'];
                $item_desc = $oder['Item_Desc'];
                $serial = $order['Serial_No'];
                $password = $order['Password'];
                $job_desc = $order['Job_Desc'];
                $price_quoted = $order['Price_Quoted'];
                $created = $order['Created'];

                // Add the order back to the database.
                $db->exec("INSERT INTO DR_Past_Orders (
                  Customer,
                  Make, 
                  Model,
                  Item_Desc,
                  Serial_No,
                  Password,
                  Job_Desc,
                  Price_Quoted,
                  Created
                ) VALUES (
                  '$customer',
                  '$make',
                  '$model',
                  '$item_desc',
                  '$serial',
                  '$password',
                  '$job_desc',
                  '$price_quoted',
                  '$created'
                );");

                // Delete the old order from the database.
                $db->exec("DELETE FROM DR_Past_Orders WHERE ID = $order_id");

                // Redirect the user back home.
                redirect('plugin-view.php?action_id=devrepairs');
              }
            }
            catch(PDOException $e){
              die($e->getMessage());
            }
          break;

          case('delete_order'):
            $id = $_GET['id'];
            $db = new Db();
            $db = $db->get();
            try{
              $db->exec("DELETE FROM DR_Active_Orders WHERE ID = $id");
            }
            catch(PDOException $e){
              die($e->getMessage());
            }

            // Take the user back to the home screen.
            redirect('plugin-view.php?action_id=devrepairs');
          break;

          case('view_order'):
            if(isset($_GET['id'])){
              // Get the order info from the database.
              $id = $_GET['id'];

              $db = new Db();
              $db = $db->get();
              try{
                $query = $db->prepare("SELECT * FROM DR_Active_Orders WHERE ID = $id");
                $query->execute();
                $result = $query->fetchAll();

                if(count($result) > 0){
                  $order = $result[0];
                }
                else{
                  die("Invalud order ID.");
                }
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              // Render the view.
              $render = 'html/admin/view-order.php';
            }
            else{
              die("Invalid ID.");
            }
          break;

          case('view_customer'):
            if(isset($_GET['id'])){
              $cust_id = $_GET['id'];

              // Get the customer from the database.
              $db = new Db();
              $db = $db->get();
              try{
                $query = $db->prepare("SELECT * FROM DR_Customers WHERE ID = $cust_id");
                $query->execute();
                $result = $query->fetchAll();
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              // Check that the customer exists
              if(count($result) > 0){
                $customer = $result[0];
              }
              else{
                die("A customer with that ID does not exist.");
              }

              // Get the customers active orders.
              try{
                $query = $db->prepare("SELECT * FROM DR_Active_Orders WHERE Customer = $cust_id");
                $query->execute();
                $active_orders = $query->fetchAll();
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              // Get the customers past orders.
              try{
                $query = $db->prepare("SELECT * FROM DR_Past_Orders WHERE Customer = $cust_id");
                $query->execute();
                $past_orders = $query->fetchAll();
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              $render = 'html/admin/view-customer.php';
            }
            else{
              die('Invalid customer ID.');
            }
          break;
          case('add_order'):
            // Get the devices makes, and models.
            $devices = $this->devices_table->fetch_all();

            // Get the customers.
            $db = new Db();
            $db = $db->get();
            try{
              $query = $db->prepare("SELECT * FROM DR_Customers");
              $query->execute();
              $result = $query->fetchAll();
            }
            catch(PDOException $e){
              die($e->getMessage());
            }
            $db = null;
            $customers = $result;

            // Check if we have any customers.
            if(count($customers) > 0){
              $has_customers = true;
            }
            else{
              $has_customers = false;
            }

            // Render the view.
            $render = "html/admin/add-order.php";
          break;
          case('add_customer'):
            if(isset($_POST['action']) && $_POST['action'] == 'update'){
              $name = $_POST['name'];
              $email = $_POST['email'];
              $phone = $_POST['phone'];

              // Check that email is not in use.
              $db = new Db();
              $db = $db->get();
              try{
                $query = $db->prepare("SELECT * FROM DR_Customers WHERE Email = '$email'");
                $query->execute();
                $result = $query->fetchAll();
              }
              catch(PDOException $e){
                die($e->getMessage());
              }

              // Check if un use.
              if(count($result) > 0){
                redirect('plugin-view.php?action_id=devrepairs&p=add-customer&email_exists');
              }
              else{
                // Add the new customer to the database.
                try{
                  $db->exec("INSERT INTO DR_Customers (Name, Email, Phone) VALUES ('$name', '$email', '$phone')");
                }
                catch(PDOException $e){
                  die($e->getMessage());
                }

                redirect("plugin-view.php?action_id=devrepairs&customer_added");
              }
            }
            else{
              $render = "html/admin/add-customer.php";
            }
          break;
        }
      }
      else{
          $render = "html/admin/home.php";
      }

      // Render the view
      if(!empty($render)){
        require_once $render;
      }
    }
  }
