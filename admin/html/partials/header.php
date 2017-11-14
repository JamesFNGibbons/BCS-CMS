<html ng-app='admin-core-app'>
  <head>
    <link rel='stylesheet' type='text/css' href='../dist/bootstrap/bootstrap.min.css'>
    <!-- <link rel='stylesheet' type='text/css' href='../dist/bootstrap/bootstrap-theme.min.css'> -->
    <link rel='stylesheet' type='text/css' href='../dist/font-awesome/css/font-awesome.min.css'>
    <link rel='stylesheet' type='text/css' href='css/admin-branding.css'>

    <!-- Include the summernote text editor -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js'></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src='../dist/bootstrap/bootstrap.min.js'></script>
    <?php get_core_js('adminCoreApp.js'); ?>
  </head>
  <body>
    <nav class='navbar navbar-custom'>
      <div class='container'>
        <a class='navbar-brand'>
          <?php print Settings::get('title'); ?>
           :: <font color='white'>Website Studio</font>
        </a>
        <ul class='nav navbar-nav pull-right'>
          <li>
            <a href='logout.php'>
              Logout
              <i class='fa fa-exit'></i>
            </a>
          </li>
        </div>
      </div>
    </nav>
