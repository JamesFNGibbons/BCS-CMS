<?php
  //
  $nav = Customizer::create_section('nav', 'Navigation Bar');
  new Option(
    array(
      "Name" => 'nav-bg-colour',
      "Label" => 'Background Colour',
      "Default" => '#000',
      "Type" => 'text',
      "Section" => $nav
    )
  );
  new Option(
    array(
      "Name" => 'nav:inverse',
      "Label" => 'Navbar Colour Scheme',
      "Default" => 'true',
      "Type" => 'select',
      "Options" => array(
        array(
          "Title" => 'Inverse',
          "Value" => 'true'
        ),
        array(
          "Title" => 'Light',
          "Value" => 'false'
        )
      ),
      "Section" => $nav
    )
  );

  // The homepage banner section
  $banner = Customizer::create_section('homepage::banner', 'Homepage Banner');
  new Option(
    array(
      "Name" => 'homepage:banner:title',
      "Label" => 'Title',
      "Default" => 'Your homepage banner',
      "Type" => 'text',
      "Section" => $banner
    )
  );
  new Option(
    array(
      "Name" => 'homepage:banner:subtitle',
      "Label" => 'Subtitle',
      "Default" => 'Banner subtitle',
      "Type" => 'text',
      "Section" => $banner
    )
  );
  new Option(
    array(
      "Name" => 'homepage:banner:bgimage',
      "Label" => 'Background Image',
      "Default" => '',
      "Type" => 'image',
      "Section" => $banner
    )
  );
