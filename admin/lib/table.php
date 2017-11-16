<?php

  require_once "bootstrap.php";

  class Table {

    public $name;
    public $columns = array();
    public $exists = true;

    /**
      * Function used to set the table name.
      * @param $name The table name.
    */
    public function __construct($name){
      $this->name = $name;
  
      if(defined('CONF-init') && constant('CONF-init')){
        // Check if the table exists
        $db = new Db();
        $db = $db->get();
        try{
            $db->query("SELECT * FROM $name");
        }
        catch(PDOException $e){
            // The table does not exist.
            $this->exists = false;
        } 
      }
    }
    
    /**
      * Function used to get all the rows in the database.
      * @return $rows The rows found.
    */
    public function fetch_all(){
        $db = new Db();
        $db = $db->get();
        try{
            $query = $db->prepare("SELECT * FROM $this->name");
            $query->execute();
            $result = $query->fetchAll();
        }
        catch(PDOException $e){
            die($e->getMessage());
        }

        $rows = $result;
        return $rows;
    }

    /**
      * Function used to add a column
      * @param $column_name The name of the new column.
      * @param $arrtibutes The attributes of the column.
    */
    public function add_column($name, $type, $attributes = array()){
      if(!$this->exists){}
        if(isset($name) && isset($type)){
            array_push($this->columns, array(
                "Name" => $name,
                "Type" => $type,
                "Attributes" => $attributes
            ));
        }
        else{
            die("Cannot add a new column. The name and type must be set.");
        }
     }

    /**
      * Function used to save the new table to the db.
    */
    public function create(){
      if(!empty($this->columns)){
        $db_string = "CREATE TABLE IF NOT EXISTS $this->name (";
        $db_string .= "ID INT AUTO_INCREMENT, ";

        foreach($this->columns as $col){
          $db_string .= $col['Name'] . " ";
          $db_string .= $col['Type'] . " ";

          // Addd the column attributes if they are there.
          if(!empty($col['Attributes'])){
            foreach($col['Attributes'] as $attr){
              $db_string .= $attr . ' ';
            }
          }

          // Add the commer to seperate this col
          $db_string .= ',';
        }
        
        // Assign the primary key of the table.
        $db_string .= "PRIMARY KEY(ID)";
        $db_string .= ');';

        // Execute the query
        $db = new Db();
        $db = $db->get();
        try{
          $db->exec($db_string);
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
      else{
        die("Cannot create the new table. No columns have been added.");
      }
    }
  }