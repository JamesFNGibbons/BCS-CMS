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
</style>
