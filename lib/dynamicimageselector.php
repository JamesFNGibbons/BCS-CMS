<?php

  /**
    * The dynamic image control is an image
    * selector that is used when multiple media selectors
    * are required, but cannot run in sync with one another.
  */

  /**
    * Function used to generate a random modal ID.
    * @return $randomString the random modal ID.
  */
  function get_modal_id($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  class DynamicImageSelector {

    public $action;
    public $param;
    public $option;

    /**
      * Conturctor used to setup the selector.
      * @param $action Where the data is sent
      * @param $param Params to be sent with the data
      * @param $option The option object.
   */
   public function __construct($action, $param, $option){
     if(isset($action) && isset($param) && isset($option)){
       $this->action = $action;
       $this->param = $param;
       $this->option = $option;

       // Create the modal ID
       $this->option['Modal-ID'] = get_modal_id();

       // Render the selector modal
       require "dynamicImageSelector/selector-modal.php";
     }
   }

   /**
     * Function used to render the selector.
   */
   public function get_selector(){
     require "dynamicImageSelector/selector-form.php";
   }
  }
