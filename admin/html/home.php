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
      <div class='col-md-12'>
        <h4 class='pull-left'>Do you want to quickly change your website?</h4>
        <a href='theme-customizer.php' class='btn btn-success btn-lg pull-right'>
          Go To Customizer
          <i class='fa fa-chevron-right'></i>
        </a>
      </div>
    </div>
  </div>
  <div class='panel panel-default'>
    <div class='panel-heading'>Tools</div>
    <div class='panel-body'>
      <div class='col-md-12'>
        <div class='col-md-2'>
          <a href='theme-customizer.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/customize.png' width='100%'>
              <b>Site Customizer</b>
            </div>
          </a>
        </div>
        <div class='col-md-2'>
          <a href='media.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/upload-circle.png' width='100%'>
              <b>Upload Media</b>
            </div>
          </a>
        </div>
        <div class='col-md-2'>
          <a href='pages.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/page.png' width='100%'>
              <b>Update Pages</b>
            </div>
          </a>
        </div>
        <div class='col-md-2'>
          <a href='users.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/add-user.png' width='100%'>
              <b>Add User</b>
            </div>
          </a>
        </div>
        <div class='col-md-2'>
          <a href='navigation.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/navigation.png' width='100%'>
              <b>Navigation Bar</b>
            </div>
          </a>
        </div>
        <div class='col-md-2'>
          <a href='settings.php' class='text-center'>
            <div class='well'>
              <img class='center-block' src='img/settings.png' width='100%'>
              <b>Settings</b>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          About this page
        </div>
        <div class='panel-body' style='height: 200px;'>
          <h3 style='margin: 0; padding: 0;'>Welcome to BCS Web Studio</h3>
          This is your main administration page for your website. From here,
          you can customize your site, update the content and upload new images
          / video files. You can also use the User Accounts tab to add other people
          who can work with you.
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          About your website
        </div>
        <div class='panel-body' style='height: 200px;'>
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
        <div class='panel-body' style='height: 200px;'>
          <?php include "html/update/changelog.php"; ?>
        </div>
    </div>
  </div>
</div>
