<?php

    require_once "bootstrap.php";

    class Option {
        public $value;
        public $name;
        public $section;
        public $type;
        public $label;

        /**
         * Constructor used to register the section.
         * @param $option_name The options name, used as the ID
         * @param $option_label The label for the option.
         * @param $default_value The default value of the option.
         * @param $option_type The options type
         * @param $section_name The name (ID) of the customizer section.
        */
        public function __construct($option_name, $option_label, $default_value = '', $option_type, $section_name, $option_options = array()){
            if(isset($option_name) && isset($section_name)){
                $db = new Db();
                $db = $db->get();
                try{
                    $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$option_name'");
                    $query->execute();
                    $result = $query->fetchAll();
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }

                // Create the option if not exists
                if(!count($result) > 0){
                    try{
                        $db->exec("INSERT INTO Theme_Options (Name, Label, Value, Type, Section_Name) VALUES (
                            '$option_name',
                            '$option_label',
                            '$default_value',
                            '$option_type',
                            '$section_name'
                        );");
                    }
                    catch(PDOException $e){
                        die($e->getMessage());
                    }
                }
                else{
                  // Get the options values.
                  try{
                      $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$option_name'");
                      $query->execute();
                      $result = $query->fetchAll();
                  }
                  catch(PDOException $e){
                      die($e->getMessage());
                  }

                  // Check if we need to update the option type.
                  if(!$result[0]['Type'] == $option_type){
                    try{
                      $db->exec("UPDATE Theme_Options SET Type = '$option_type' WHERE Name = '$option_name'");
                    }
                    catch(PDOException $e){
                      die($e->getMessage());
                    }

                    // Change the result type in the found object
                    $result[0]['Type'] = $option_type;
                  }
                }

                // Add the customizer select options if it is a selector
                if($option_type == 'select'){
                  if(empty($option_options)){
                    die("Invalid number of options given for select type.");
                  }

                  // Get the option ID
                  $option_id = null;
                  try{
                    $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$option_name'");
                    $query->execute();
                    $result = $query->fetchAll();
                    if(!count($result) > 0){
                      die("Internal server error. Please contact support.");
                    }
                    $option_id = $result[0]['ID'];
                  }
                  catch(PDOException $e){
                    die($e->getMessage());
                  }

                  // Create the selector options.
                  foreach($option_options as $option){
                    try{
                      $title = $option['Title'];
                      $query = $db->prepare("SELECT * FROM Select_Options WHERE Option_ID = '$option_id' and Option_Title = '$title'");
                      $query->execute();
                      $result = $query->fetchAll();
                    }
                    catch(PDOException $e){
                      die($e->getMessage());
                    }

                    // Check if the optivon exists
                    if(count($result) == 0){
                      try{
                        $title = $option['Title'];
                        $value = $option['Value'];

                        $db->exec("INSERT INTO Select_Options (Option_ID, Option_Title, Option_Value) VALUES (
                          '$option_id',
                          '$title',
                          '$value'
                        )");
                      }
                      catch(PDOException $e){
                        die($e->getMessage());
                      }
                    }
                  }
                }

                $db = null;

                $this->value = $result[0]['Value'];
                $this->name = $option_name;
                $this->type = $result[0]['Type'];
                $this->label = $result[0]['Label'];
                $this->section = $section_name;
            }
        }
    }
