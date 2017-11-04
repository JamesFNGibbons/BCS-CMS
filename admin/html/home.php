<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Welcome, <?php print $user->get_name(); ?></h2>
      <span>Not you? (<a href='logout.php'>Sign Out</a>)</span>
    </div>
  </div>
  <?php if($version_change): ?>
    <div class='alert alert-info'>
      <b>Info: </b>
      Your software has been updated to version
      <b><?php print Settings::get('software_version'); ?></b>
    </div>
  <?php endif; ?>
  <div class='well'>
    <div class='row'>
      <div class='col-md-11'>
        <h4 class='pull-left'>Do you want to quickly change your website?</h4>
        <a href='theme-customizer.php' class='btn btn-success btn-lg pull-right'>
          Go To Customizer
          <i class='fa fa-chevron-right'></i>
        </a>
      </div>
    </div>
  </div>
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
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          About your website
        </div>
        <div class='panel-body'>
          <img src='../dist/bcs-cp/bcs-cp-logo.png' width='100%'>
          <br><br>
          <p>Software Version: <?php print $software_version; ?></p>
          <p>Last Updated: <?php print $last_updated; ?></p>
          <a class='btn btn-primary' href='update.php'>
            <i class='fa fa-wrench'></i>
            Check for updates
          </a>
        </div>
      </div>
    </div>
    <div class='col-md-5'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Whats new in version <?php print $software_version; ?>
        </div>
        <div class='panel-body'>
          <?php include "html/update/changelog.php"; ?>
        </div>
    </div>
  </div>
</div>
