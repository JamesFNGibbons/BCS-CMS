<div class='container'>
  <div class='jumbotron'>
    <h2><?php print get_theme_option('homepage-banner-title'); ?></h2>
    <p><?php print get_theme_option('homepage-banner-content'); ?></p>
  </div>

  <!-- The Homepage Services Section -->
  <div class='row'>
    <?php for($i = 1; $i < 4; $i++): ?>
      <div class='col-md-4'>
        <?php if(get_theme_option("homepage:service:$i:image")): ?>
          <img src='<?php print get_theme_option("homepage:service:$i:image"); ?>' width='100%'>
        <?php else: ?>
          <img src='http://saveabandonedbabies.org/wp-content/uploads/2015/08/default.png' width='100%'>
        <?php endif; ?>

        <h2><?php print get_theme_option("homepage:service:$i:title"); ?></h2>
        <p><?php print get_theme_option("homepage:service:$i:content"); ?></p>
      </div>
    <?php endfor; ?>
  </div>
  
  <div class='well'>
    <h2><?php print get_theme_option('homepage:about:title'); ?></h2>
    <img src='<?php print get_theme_option("homepage:about:image"); ?>'>
  </div>
</div>
