<?php

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
