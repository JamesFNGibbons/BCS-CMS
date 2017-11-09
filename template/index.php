<div class='homepage-banner'>
  <div class='overlay'>
    <div class='container'>
      <div class='wrap'>
        <h1><?php print get_theme_option('homepage:banner:title'); ?></h1>
        <h2><?php print get_theme_option('homepage:banner:subtitle'); ?></h2>
      </div>
    </div>
  </div>
</div>
<div class='container'>
  <br><br>
  <!-- The Homepage Services Section -->
  <div class='row'>
    <?php for($i = 1; $i < 4; $i++): ?>
      <div class='col-md-4'>
        <?php if(get_theme_option("homepage:service:$i:image")): ?>
          <img src='<?php print get_theme_option("homepage:service:$i:image"); ?>' width='100%'>
        <?php else: ?>
          <img src='http://saveabandonedbabies.org/wp-content/uploads/2015/08/default.png' width='100%'>
        <?php endif; ?>

        <h2 class='text-center'><?php print get_theme_option("homepage:service:$i:title"); ?></h2>
        <p class='text-center'><?php print get_theme_option("homepage:service:$i:content"); ?></p>
      </div>
    <?php endfor; ?>
  </div>

  <br><br>
</div>
<div class='homepage-about'>
  <div class='container'>
    <div class='wrap'>
      <div class='col-md-4'>
        <img width='100%' src='<?php print get_theme_option("homepage:about:image"); ?>'>
      </div>
      <div class='col-md-8'>
        <h1><?php print get_theme_option('homepage:about:title'); ?></h1>
        <h4><?php print get_theme_option('homepage:about:content'); ?></h4>
      </div>
    </div>
  </div>
</div>
