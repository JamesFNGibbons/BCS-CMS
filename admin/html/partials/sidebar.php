<div class='col-md-2'>
  <div class='thumbnail'>
    <div class='list-group'>
      <a href='index.php' class='list-group-item'>
        <i class='fa fa-home'></i>
        Home
      </a>
      <br>
      <div class='panel panel-default'>
        <div class='panel-heading'>Homepage Options</div>
        <div class='panel-body'>
          <a href='homepage-settings.php' class='list-group-item'>
            <i class='fa fa-cog'></i>
            Homepage Settings
          </a>
          <?php if(Homepage::display('top-banner')): ?>
            <a href='homepage-top-banner.php' class='list-group-item'>
              <i class='fa fa-bars'></i>
              Homepage Top Banner
            </a>
          <?php endif; ?>
        </div>
      </div>
      <br>
      <div class='panel panel-default'>
        <div class='panel-heading'>Website Pages</div>
        <div class='panel-body'>
          <a href='pages.php' class='list-group-item'>
            <i class='fa fa-book'></i>
            Current Existing Pages
          </a>
          <a href='pages.php' class='list-group-item'>
            <i class='fa fa-plus'></i>
            Create New Page
          </a>
        </div>
      </div>
      <br>
      <div class='panel panel-default'>
        <div class='panel panel-default'>
          <div class='panel-heading'>User Accounts</div>
          <div class='panel-body'>
            <a href='users.php' class='list-group-item'>
              <i class='fa fa-user'></i>
              View Admin Users
            </a>
            <a href='users.php' class='list-group-item'>
              <i class='fa fa-plus'></i>
              Add New Admin User
            </a>
          </div>
        </div>
      </div>

      <a href='setting.php' class='list-group-item'>
        <i class='fa fa-cog'></i>
        Global Settings
      </a>
    </div>
  </div>
</div>
