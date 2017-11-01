<?php

require_once "../lib/bootstrap.php";
require_once "html/partials/header.php";
require_login();

// Array of views to Render
$to_render = array();

include "../lib/customizer.php";

// Load the themes functions.php file for the customizer
if(file_exists('../template/functions.php')){
  include "../template/functions.php";
}

// Check if any settings have been saved.
if(isset($_GET['saved'])){
  $settings_saved = true;
}
else{
  $settings_saved = false;
}

// Render the customizer sidebar header
array_push($to_render, 'html/customizer/partials/sidebar-header.php');

// Check if the section has been chosen.
if(isset($_GET['section'])){
  $section = $_GET['section'];

  // Check if the section is the branding options.
  if($section == 'branding'){
    // Check if we need to update the title
    if(isset($_POST['action']) && $_POST['action'] == 'update'){
      $title = $_POST['title'];
      Settings::set('title', $title);
      header('Location: theme-customizer.php?saved');
    }

    /**
      * Setup the select media modal for the site logo, and
      * append the selected section param to the end of the
      * select_media_action url.
    */
    $select_media_param = 'section=branding';
    $select_media_action = 'theme-customizer.php';

    include "html/modals/select-media.php";

    // Update the logo if it is changed by the customizer
    if(isset($_GET['selected_media'])){
      Settings::set('branding-logo', $_GET['selected_media']);
      header('Location: theme-customizer.php?section=branding');
    }

    $section_title = 'Website Branding';
    array_push($to_render, "html/customizer/branding.php");
  }
  else{
    // Check if the name is valid
    $is_section_name_valid = false;
    foreach($customizer_sections as $sect){
      if($sect['Name'] == $section){
        $is_section_name_valid = true;
        $the_section = $sect;
      }
    }

    // Ensure the section is valid.
    if(!$is_section_name_valid){
      die('Invalid customizer section name.');
    }

    // Set the section title based on the registered section title.
    $section_title = $the_section['Title'];

    // Get the sub-sections
    $sub_sections = array();
    foreach($customizer_sections as $sect){
      if($sect['Parent'] == $the_section['Name']){
        array_push($sub_sections, $sect);
      }
    }

    // Get the dynamic options associated with the section.
    $options = Customizer::get_options($the_section['Name']);
    array_push($to_render, 'html/customizer/dynamic-options.php');

    // Check if the have been saved
    if(isset($_POST['action']) && $_POST['action'] == 'update'){
      foreach($options as $option){
        if($option['Type'] == 'text'){
          Customizer::update_option($option['Name'], $_POST[$option["Name"]]);
        }
      }

      // Redirect the user back to the options page
      header("Location: theme-customizer.php?section=$section&saved");
    }

    // Handle an image control being submitted
    if(isset($_GET['selected_media']) && isset($_GET['option'])){
      Customizer::update_option($_GET['option'], $_GET['selected_media']);
      header("Location: theme-customizer.php?section=$section");
    }
  }
}
else{
  $section_title = 'Main Menu';

  // Define the sections array, and add the branding section.
  $sections = array();
  array_push($sections, array(
    'ID' => 'branding',
    'Name' => 'branding',
    'Title' => 'Branding Options'
  ));

  // Get the sections from the database, and render the view.
  foreach(Customizer::get_sections() as $section){
    if(empty($section['Parent'])){
      array_push($sections, $section);
    }
  }
  array_push($to_render, "html/customizer/sections.php");
}

// Render the customizer sidebar footer and preview
array_push($to_render, 'html/customizer/partials/sidebar-footer.php');
array_push($to_render, "html/customizer/preview.php");


// Render each item in the to_render array in the correct order.
foreach($to_render as $render){
  include $render;
}
