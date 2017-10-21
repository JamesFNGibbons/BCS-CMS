<div class='col-md-2 col-md-offset-5'>
  <form action='index.php' method='post'>
    <h2>Welcome
      <span style='font-size: 17px'>
        Please sign in
      </span>
    </h2>
    <?php if(isset($login_error) && $login_error): ?>
      <div class='alert alert-danger'>
        <b>Invalid Login!</b>
        Your username or password is incorrect
      </div>
    <?php endif; ?>
    <div class='form-group'>
      <lable>Username</lable>
      <input type='text' class='form-control' name='username'>
    </div>
    <div class='form-group'>
      <lable>Password</lable>
      <input type='password' class='form-control' name='password'>
    </div>
    <div class='form-group'>
      <input type='submit' class='btn btn-primary pull-right' value='Login'>
    </div>
  </form>
</div>
