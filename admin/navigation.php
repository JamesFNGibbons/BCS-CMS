<?php

  require_once "../lib/bootstrap.php";
  require_once "html/partials/header.php";
  require_once "html/partials/sidebar.php";
  require_login();

  // Get the navbar items.
  $items = array();
  foreach(Nav::get_items() as $item){
    if(empty($item['Parent'])){
      array_push($items, $item);
    }
    else{
      // Check if the parent item exists in the items array.
      foreach($items as $parent_item){
        if($item['Parent'] == $parent_item['ID']){
          // Get the index of the item in the nav items array
          $index = array_search($item, $items);

          // Define the sub items array if is null
          if(empty($items[$index]['Sub_Items'])){
            $items[$index]['Sub_Items'] = array();
          }
          // Add the new item to the sub array.
          array_push($items[$index]['Sub_Items'], $item);
        }
      }
    }
  }

  // Filter the navbar items to only include the parents.
  $parent_items = array();
  foreach($items as $item){
    if(empty($item['Parent'])){
      array_push($parent_items, $item);
    }
  }

  // Get the pages that have not been added to the navbar
  $unadded_pages = Page::get_pages();
  foreach($unadded_pages as $page){
    // Check that the page has not already been added.
    foreach($items as $item){
      if($item['Type'] == 'page'){
        if($item['Page_ID'] == $page["ID"]){
          // Remove the page from the list, it has already been added.
          $index = array_search($page, $unadded_pages);
          unset($unadded_pages[$index]);
        }
      }
    }
  }

  if(isset($_POST['action'])){
    switch($_POST['action']){
      case('add_item'):
        if($_POST['parent'] !== 'none'){
          $parent = $_POST['parent'];
        }
        else{
          $parent = null;
        }
        Nav::add_item(array("Type" => 'link'), $_POST['title'], $_POST['link'], $parent);
        redirect('navigation.php');
      break;
      case('update'):
        if(isset($_POST['title']) && isset($_POST['link']) && isset($_POST['id'])){
          Nav::update_item(
            $_POST['id'],
            $_POST['title'],
            $_POST['link'],
            $_POST['parent']
          );
          redirect('navigation.php');
        }
        else{
          die('Invalid request to update nav item.');
        }
      break;
      case('delete'):
        if(isset($_POST['id'])){
          Nav::remove_item($_POST['id']);
          redirect('navigation.php');
        }
        else{
          die('Invalid ID submitted.');
        }
      break;
      case('add_page'):
        if(isset($_POST['id'])){
          // Get the page info, and create the link.
          $page = new Page($_POST['id']);
          Nav::add_item(
            array(
              "Type" => 'page',
              "Page_ID" => $page->id
            ),
            $page->title,
            $page->uri,
            null
          );
          redirect('navigation.php');
        }
      break;
      case('update_priority'):
        if(isset($_POST['id']) && isset($_POST['priority'])){
          Nav::set_item_priority($_POST['id'], $_POST['priority']);
          redirect('navigation.php');
        }
      break;
      case('update-autoadd-setting'):
        if(isset($_POST['auto_add_pages'])){
          Settings::set('navbar-auto-add-pages', $_POST['auto_add_pages']);
        }
        redirect('navigation.php');
      break;
      default:
        die('Unknown request - ' . $_POST['action']);
    }
  }
  else{
    require_once "html/navigation.php";
  }
