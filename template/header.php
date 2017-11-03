<html>
  <head>
    <title><?php the_site_title(); ?> :: <?php the_title(); ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php the_seo_tags(); ?>

    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  </head>
  <body>
    <nav class='navbar navbar-default'>
      <div class='container'>
        <a class='navbar-brand'>
          <?php if(has_logo()): ?>
            <?php the_logo('', '75px'); ?>
          <?php else: ?>
            <?php the_site_title(); ?>
          <?php endif; ?>
        </a>
      </div>
    </nav>
