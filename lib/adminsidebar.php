<?php
  global $admin_sidebar_items;
  $admin_sidebar_items = array(
    array(
      "Title" => 'Home',
      "Link" => 'index.php',
      "Icon" => 'fa fa-home',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Your Account',
      "Link" => 'account.php',
      "Icon" => 'fa fa-user',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Media Center',
      "Link" => 'media.php',
      "Icon" => 'fa fa-file',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Website Customizer',
      "Link" => 'theme-customizer.php',
      "Icon" => 'fa fa-gears',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Pages',
      "Link" => 'pages.php',
      "Icon" => 'fa fa-book',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Blog Posts',
      "Link" => 'blog.php',
      "Icon" => 'fa fa-pencil',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Navbar Menu',
      "Link" => 'navigation.php',
      "Icon" => 'fa fa-bars',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'User Accounts',
      "Link" => 'users.php',
      "Icon" => 'fa fa-users',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Plugins',
      "Link" => 'plugins.php',
      "Icon" => 'fa fa-cubes',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'Website Settings',
      "Link" => 'setting.php',
      "Icon" => 'fa fa-gear',
      "Type" => 'static-item'
    ),
    array(
      "Title" => 'License Info',
      "Link" => 'license.php',
      "Icon" => 'fa fa-pencil-square-o',
      "Type" => 'static-item'
    )
  );

/**
  * Function used to add a new item to the navigation.
  * @param $item The new item as an array
*/
function add_admin_sidebar_item($item){
  global $admin_sidebar_items;
  // Add the new item to the admin_sidebar array.
  array_push($admin_sidebar_items, $item);
}

/**
 * Function used to add a new acton item to the navigation.
 * @param $item, @param $action
*/
function add_admin_sidebar_action_item($item){
  if(isset($item)){
    global $admin_sidebar_items;
    array_push($admin_sidebar_items, $item);
  }
}
