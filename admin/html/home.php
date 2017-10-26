<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Welcome, <?php print $user->get_name(); ?></h2>
      <span>Not you? (<a href='logout.php'>Sign Out</a>)</span>
    </div>
  </div>
  <?php if($has_warnings): ?>
    <div class='alert alert-danger'>
      <b>Caution!</b>
      BCS Web Pro has detected <b><?php print count($warnings); ?></b> Errors.
      (<a href='#'>View</a>)
    </div>
  <?php endif; ?>
  <div class='row'>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          What do you want to do?
        </div>
        <div class='panel-body'>
          <div class='list-group'>
            <div class='list-group-item'>
              <img src='static/images/wm-login.png' width='100%'>
            </div>
            <div class='list-group-item'>
              <img src='static/images/cp-login.png' width='100%'>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='col-md-5'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Recent news from Bespoke Computer Software
        </div>
        <div class='panel-body'>
          <?php foreach($recent_news as $news): ?>
            <div class='list-group'>
              <a class='list-group-item'>

              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          About your website
        </div>
        <div class='panel-body'>
          <img src='../dist/bcs-cp/bcs-cp-logo.png' width='100%'>
          <br><br>
          <?php if($has_warnings): ?>
          <p class='text-danger'>
            There are <?php print count($warnings); ?> Warnings
            (<a href='#'>View</a>)
          </p>
           <?php endif; ?>
          <p>Software Version: <?php print $software_version; ?></p>
          <p>Last Updated: <?php print $last_updated; ?></p>
          <a class='btn btn-primary' href='update.php'>
            <i class='fa fa-wrench'></i>
            Check for updates
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
