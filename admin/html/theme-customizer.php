<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Theme Customizer</h2>
      <p>Choose what sections should be displayed on the homepage</p>
      <span>Last Updated (<?php print $last_updated; ?>)</span>
    </div>
  </div>
  <form method='post'>
    <input type='hidden' name='action' value='update'>
    <div class='page-header'>
      <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
      <br><br>
    </div>
    <div class='row'>
      <div class='col-md-3'>
        <div class='form-check'>
          <lable class='form-check-label'>
            Display Top Banner
            <?php if($display_top_banner): ?>
              <input type='checkbox' name='top-banner' class='form-check-input' value='true' checked>
            <?php else: ?>
              <input type='checkbox' name='top-banner' class='form-check-input' value='true'>
            <?php endif; ?>
          </lable>
        </div>
      </div>
    </div>
  </form>
</div>
