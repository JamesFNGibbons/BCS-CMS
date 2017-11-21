<div class='col-md-9'>
    <div class='jumbotron'>
        <div class='container'>
            <h2>Your Account</h2>
            <p>Update / Change your account information.</p>
        </div>
    </div>
    <?php if($account_updated): ?>
      <div class='alert alert-success'>
        <i class='fa fa-check'></i>
        The changes to your account have been saved.
        <a class='close' href='account.php'>&times;</a>
      </div>
    <?php endif; ?>
    <?php if($password_updated): ?>
      <div class='alert alert-success'>
        <i class='fa fa-check-circle'></i>
        Your password has been updated.
        <a class='close' href='account.php'>&times;</a>
      </div>
    <?php endif; ?>
    <?php if($password_error): ?>
      <div class='alert alert-danger'>
        <i class='fa fa-times'></i>
        Your passwords do not match. Your password has not been updated.
        <a class='close' href='account.php'>&times;</a>
      </div>
    <?php endif; ?>
    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Account Information</div>
                <div class='panel-body'>
                    <form method='post'>
                        <input type='hidden' name='action' value='update'>
                        <div class='form-group'>
                            <label>Name</label>
                            <input type='text' name='name' value='<?php print $user->name; ?>' class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label>Email</label>
                            <input type='email' name='email' value='<?php print $user->email; ?>' class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label>Username</label>
                            <input value='<?php print $user->username; ?>' disabled='disabled' class='form-control'>
                        </div>
                        <div class='form-group'>
                          <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
          <div class='panel panel-default'>
            <div class='panel-heading'>Update your password</div>
            <div class='panel-body'>
              <form method='post'>
                <input type='hidden' name='action' value='update-password'>
                <div class='form-group'>
                  <label>Password</label>
                  <input type='password' name='password' class='form-control'>
                </div>
                <div class='form-group'>
                  <label>Repeat Password</label>
                  <input type='password' name='password2' class='form-control'>
                </div>
                <div class='form-group'>
                  <input type='submit' class='btn btn-primary pull-right' value='Update Password'>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
