<html>
  <head>
    <link rel='stylesheet' type='text/css' href='../dist/bootstrap/bootstrap.min.css'>
    <!-- <link rel='stylesheet' type='text/css' href='../dist/bootstrap/bootstrap-theme.min.css'> -->
    <link rel='stylesheet' type='text/css' href='../dist/font-awesome/css/font-awesome.min.css'>
    <link rel='stylesheet' type='text/css' href='css/admin-branding.css'>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js'></script>
    <script src='../dist/bootstrap/bootstrap.min.js'></script>
    <script src="../dist/ckeditor/ckeditor.js"></script>
    <?php get_core_js('ckeditor.js'); ?>
    <?php the_plugin_js(); ?>
  </head>
  <body>
    <nav class='navbar navbar-custom'>
      <div class='container'>
        <a class='navbar-brand'>
          <?php print Settings::get('title'); ?>
           :: <font color='white'>Website Studio</font>
        </a>
        <ul class='nav navbar-nav pull-right'>
          <?php if(is_loggedin()): ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle='dropdown' href="#">
                <?php $user = new User($_SESSION['username']); ?>
                <?php print $user->name; ?>
              </a>
              <ul style="right:auto; left: auto;" class="dropdown-menu dropdown-menu-right">
                 <li><a href='account.php'>Your Account</a></li>
                 <li><a href='logout.php'>Logout</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
        </div>
      </div>
    </nav>
