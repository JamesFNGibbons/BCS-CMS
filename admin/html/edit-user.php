<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Edit User "<font color='white'><?php print $user->name; ?></font>"</h2>
      <p>Change / Delete this user.</p>
    </div>
  </div>
  <div class='page-header'>
    <a href='users.php'>
      <i class='fa fa-arrow-left'></i>
      Go Back
    </a>
  </div>
  <?php if($updated): ?>
    <div class='alert alert-success'>
      <i class='fa fa-check-circle'></i>
      Your changes have been saved.
      <a class='close' data-dismiss='alert'>
        &times;
      </a>
    </div>
  <?php endif; ?>
  <?php if($password_updated): ?>
    <div class='alert alert-success'>
      <i class='fa fa-check-circle'></i>
      You have upadted this users password.
      <a class='close' data-dismiss='alert' href='edit-user.php'>
        &times;
      </a>
    </div>
  <?php endif; ?>
  <div class='well'>
    This user last logged in on
    <b><?php print $user->last_login; ?></b>
  </div>
  <div class='row'>
    <div class='col-md-5'>
      <div class='panel panel-default'>
        <div class='panel-heading'>User details</div>
        <div class='panel-body'>
          <form method='post'>
            <input type='hidden' name='action' value='update'>
            <input type='hidden' name='username' value='<?php print $user->username; ?>'> 
            <div class='row'>
              <div class='col-md-12'>
                <div class='form-group'>
                  <lable>Full Name</lable>
                  <input name='name' value='<?php print $user->name; ?>' class='form-control'>
                </div>
                <div class='form-group'>
                  <lable>Email</lable>
                  <input name='email' value='<?php print $user->email; ?>' class='form-control'>
                </div>
                <div class='form-group'>
                  <lable>Username</lable>
                  <input disabled='disabled' value='<?php print $user->username; ?>' class='form-control'>
                </div>
                <div class='form-group'>
                  <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Change users password</div>
        <div class='panel-body'>
          <?php if($password_unmatch): ?>
            <div class='alert alert-danger'>
              <i class='fa fa-times-circle'></i>
              The passwords do not match. 
              <a class='close' data-dismiss='alert'>
                &times;
              </a>
            </div>
          <?php endif; ?>
          <form method="post">
            <input type='hidden' name='action' value='update-password'>
            <input type='hidden' name='id' value='<?php print $user->username; ?>'>
            <div class='form-group'>
              <lable>New Password</lable>
              <input type='password' name="password" class='form-control'>
            </div>
            <div class='form-group'>
              <lable>Repeat Password</lable>
              <input type='password' name="password2" class='form-control'>
            </div>
            <div class='form-group'>
              <input type='submit' class='btn btn-primary pull-right' value='Update Password'>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Quick Actions</div>
        <div class='panel-body'>
          <div class='list-group'>
            <a class='list-group-item' href='edit-user.php?id=<?php print $user->id; ?>&action=delete'>
              <i class='fa fa-trash'></i>
              Delete User
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
