<style>
  nav.navbar.navbar-prenav {
    <?php if(get_theme_option('nav-bg-colour')): ?>
      background-color: <?php print get_theme_option('nav-bg-colour'); ?>;
    <?php endif; ?>
    <?php if(get_theme_option('nav-text-colour')): ?>
      color: <?php print get_theme_option('nav-text-colour'); ?>;
    <?php endif; ?>

    height: 98px;
    border-radius: 0;
  }

  nav.navbar-theNav
  {
    top: -20px;
    border-radius: 0;
  }

  div.overlay {
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
  }

  /* The homepage banner */
  div.homepage-banner {
    width: 100%;
    height: 400px;
    margin-top: -40px;
    background-size: 100% 100%;
    background-attachment: fixed;

    <?php if(get_theme_option('homepage:banner:bgimage')): ?>
      background-image: url(<?php print get_theme_option('homepage:banner:bgimage'); ?>);
    <?php else: ?>
      background-color: grey;
    <?php endif; ?>
  }

  div.homepage-banner h1 {
    color: white;
    font-size: 70px;
  }

  div.homepage-banner h2 {
    color: grey;
  }

  div.homepage-banner div.wrap
  {
    margin-top: 100px;
  }

  /** The homepage about */
  div.homepage-about
  {
    <?php if(get_theme_option('homepage:about:bgimage')): ?>
      background-image: url("<?php print get_theme_option('homepage:about:bgimage'); ?>");
    <?php else: ?>
        background-color: #00387d;
    <?php endif; ?>
    width: 100%;
    height: 500px;
  }

  div.homepage-about h1
  {
    font-size: 70px;
    color: white;
  }

  div.homepage-about div.wrap
  {
    margin-top: 100px;
  }

  div.homepage-about h4
  {
    font-weight: normal;
    color: white;
  }

  div.homepage-second-banner {
    width: 100%;
    height: 500px;

    <?php if(get_theme_option('homepage:second-banner:bgimage')): ?>
      background-image: url(<?php print get_theme_option('homepage:second-banner:bgimage'); ?>);
    <?php else: ?>
      background-image: url('template/img/banner2.jpeg');
    <?php endif; ?>

    color: white;
  }

  div.homepage-second-banner h1 {
    font-size: 70px;
  }
</style>
