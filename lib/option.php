<?php
    
    require_once "bootstrap.php";
    
    class Option {
        public $value;
        
        /** 
         * Constructor used to register the section.
        */
        public function __construct($option_name, $section_name){
            if(isset($option_name) && isset($section_name)){
                $db = new Db();
                $db = $db->get();
                try{
                    $query = $db->prepare("SELECT * FROM Theme_Options WHERE Name = '$name'");
                    $query->execute();
                    $result = $query->fetchAll();
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                // Create the section if not exists
                if(!count($result) > 0){
                    try{
                        $db->exec("INSERT INTO Theme_Options (Name, Section, Value) VALUES (
                            '$option_name',
                            '$section_name',
                            ''
                        );");
                    }
                    catch(PDOException $e){
                        die($e->getMessage());
                    }
                }
                
                $this->value = $result[0]['Value'];
            }
        }
    }