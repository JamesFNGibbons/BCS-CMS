<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>User Accounts</h2>
      <span>
        Quickly create, delete or modify user accounts who can access this admin portal.
      </span>
    </div>
  </div>
  <?php if($access_denied): ?>
    <div class='alert alert-danger'>
      <i class='fa fa-times-circle'></i>
      You cannot edit users. Only root user '<?php print $root_user; ?>'
      can edit accounts.
    </div>
  <?php endif; ?>
  <?php if($user_invalid): ?>
    <div class='alert alert-danger'>
      <i class='fa fa-times-circle'></i>
      Could not edit user. Invalid request.
      <a data-dismiss='alert' class='close'>
        &times;
      </a>
    </div>
  <?php endif; ?>
  <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Current users
        </div>
        <div class='panel-body'>
          <table class='table table-default'>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <?php foreach($users as $user): ?>
              <tr>
                <td><?php print $user['Name']; ?></td>
                <td><?php print $user['Username']; ?></td>
                <td><?php print $user['Email']; ?></td>
                <td>
                  <?php if($user['Username'] == $_SESSION['username']): ?>
                    <a href='account.php'>
                      Your Account
                    </a>
                  <?php else: ?>
                    <a href='edit-user.php?username=<?php print $user["Username"]; ?>'>
                      Edit Account
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Quick create new user
        </div>
        <div class='pane-body'>
          <div class='well'>
            <form method='post'>
              <div class='form-group'>
                <lable>Name</lable>
                <input type='text' name='name' class='form-control' required>
              </div>
              <div class='form-group'>
                <lable>Email</lable>
                <input type='email' name='email' class='form-control' required>
              </div>
              <div class='form-group'>
                <lable>Username</lable>
                <input type='text' name='username' class='form-control' required>
              </div>
              <div class='form-group'>
                <lable>Password</lable>
                <input type='password' name='password' class='form-control' required>
              </div>
              <div class='form-group'>
                <input type='submit' class='btn btn-primary form-control' value='Create User'>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
