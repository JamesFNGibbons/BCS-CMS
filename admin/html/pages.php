<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Pages</h2>
      <span>
        Quickly create, delete or modify the pages on your website.
      </span>
    </div>
  </div>
  <?php if(isset($creation_error) && $creation_error): ?>
    <div class='alert alert-danger'>
      <b>Error!</b>
      It has not been possible to create the new page at this time.
    </div>
  <?php endif; ?>
  <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Existing Pages
        </div>
        <div class='panel-body'>
          <table class='table table-default'>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>

          </table>
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Quick create new page
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
