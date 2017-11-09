<?php

  $nav = Customizer::create_section('nav', 'Navigation Bar');
  new Option(
    'nav-bg-colour',
    'Background Colour',
    '#000',
    'text',
    $nav
  );
  new Option(
    'nav-text-colour',
    'Text Colour',
    '#6d9dbd',
    'text',
    $nav
  );
  new Option(
    'navbar-inverse',
    'Use the navbar inverse theme',
    'true',
    'select',
    $nav
  );

  $banner = Customizer::create_section('homepage-banner', 'Homepage Banner');
  new Option(
      'homepage-banner-title',
      'Banner Title',
      '',
      'text',
      $banner
  );
  new Option(
      'homepage-banner-content',
      'Banner Content',
      '',
      'text',
      $banner
  );

  // Create the services section and options
  $services = Customizer::create_section('homepage:services', 'Homepage Services');

  for($i = 1; $i < 4; $i++){
    new Option(
      "homepage:service:$i:title",
      "Service $i Title",
      '',
      'text',
      $services
    );

    new Option(
      "homepage:service:$i:content",
      "Service $i Content",
      '',
      'textarea',
      $services
    );

    new Option(
      "homepage:service:$i:image",
      "Service $i Image",
      '',
      'image',
      $services
    );
  }

  /**
   * The about us section on the homepage
  */
  $services = Customizer::create_section('homepage:about', 'Homepage About Us');
  new Option(
    'homepage:about:title',
    'Section Title',
    'About Our Company',
    'text',
    $services
  );

  new Option(
    'homepage:about:image',
    'Image',
    '',
    'image',
    $services
  );
