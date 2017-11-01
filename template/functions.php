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
  new Option(
      'homepage-banner-image',
      'Banner Background Image',
      '',
      'image',
      $banner
  );
  new Option(
      'homepage-banner-overlay-image',
      'Banner Overlay Image',
      '',
      'image',
      $banner
  );
