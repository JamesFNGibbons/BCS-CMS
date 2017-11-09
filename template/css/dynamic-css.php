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
    background-color: rgba(0,0,0,0.5);
  }

  /* The homepage banner */
  div.homepage-banner {
    width: 100%;
    height: 500px;
    margin-top: -40px;

    <?php if(get_theme_option('homepage:banner:bgimage')): ?>
      background-image: url(<?php print get_theme_option('homepage:banner:bgimage'); ?>);
    <?php else: ?>
      background-color: grey;
    <?php endif; ?>
  }

  div.homepage-banner h1 {
    color: white;
  }
</style>
