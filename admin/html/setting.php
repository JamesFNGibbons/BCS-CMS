<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Website Settings</h2>
      <p>Change your websites settings</p>
    </div>
  </div>
  <form method='post' action='setting.php'>
    <input type='hidden' name='action' method='post'>
    <div class='page-header'>
      <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
      <br><br>
    </div>
    <div class='thumbnail'>
      <div class='row'>
        <div class='col-md-4'>
          <div class='form-group'>
            <lable>Site Title</lable>
            <input type='text' name='title' class='form-control' value='<?php print Settings::get("title"); ?>'>
          </div>
          <div class='form-group'>
            <lable>Site Subtitle</lable>
            <input type='text' name='subtitle' class='form-control' value='<?php print Settings::get("subtitle"); ?>'>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
