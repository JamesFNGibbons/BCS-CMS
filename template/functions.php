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

  // The homepage services section
  $services = Customizer::create_section('homepage:services', 'Homepage services');
  for($i = 1; $i < 4; $i++){
    new Option(
      array(
        "Name" => "homepage:service:$i:title",
        "Label" => "Service $i Title",
        "Default" => "Service $i",
        "Type" => 'text',
        "Section" => $services
      )
    );
    new Option(
      array(
        "Name" => "homepage:service:$i:content",
        "Label" => "Service $i Content",
        "Default" => "Some information about a service that your business offers.",
        "Type" => 'textarea',
        "Section" => $services
      )
    );
    new Option(
      array(
        "Name" => "homepage:service:$i:image",
        "Label" => "Service $i Image",
        "Default" => "",
        "Type" => 'image',
        "Section" => $services
      )
    );
  }

  // The homepage about us section
  $about = Customizer::create_section('homepage:about', 'Homepage About Us');
  new Option(
    array(
      "Name" => "homepage:about:title",
      "Label" => "Section Title",
      "Default" => "About Our Company",
      "Type" => 'text',
      "Section" => $about
    )
  );
  new Option(
    array(
      "Name" => "homepage:about:content",
      "Label" => "Section Content",
      "Default" => "",
      "Type" => 'textarea',
      "Section" => $about
    )
  );
  new Option(
    array(
      "Name" => "homepage:about:image",
      "Label" => "Image",
      "Default" => "",
      "Type" => 'image',
      "Section" => $about
    )
  );
