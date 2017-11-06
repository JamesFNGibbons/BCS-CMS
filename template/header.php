<html>
  <head>
    <title><?php the_site_title(); ?> :: <?php the_title(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php the_seo_tags(); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  </head>
  <body>
    <nav class='navbar navbar-default'>
      <div class='container'>
        <a class='navbar-brand'>
          <?php if(has_logo()): ?>
            <?php the_logo('', '60px'); ?>
          <?php else: ?>
            <?php the_site_title(); ?>
          <?php endif; ?>
        </a>
        
        <?php the_bootstrap_nav("<ul class='nav navbar-nav pull-right'>"); ?>
      </div>
    </nav>
