<form method='post' action='?section=branding'>
  <input type='hidden' name='action' value='update'>
  <div class='form-group'>
    <lable>Website Title</lable>
    <input type='text' name='title' class='form-control' value='<?php print Settings::get("title"); ?>'>
  </div>
  <div class='form-group'>
    <lable>Site Logo</lable>
    <div class='form-control' style='height: 43px;'>
      <span style='line-height: 30px;' class='pull-left'>
        <?php print Settings::get('branding-logo'); ?>
      </span>
      <span data-toggle='modal' data-target='.modal.select_media' class='btn btn-primary btn-sm pull-right'>
        Choose Image
      </span>
    </div>
  </div>
  <div class='form-group'>
    <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
  </div>
</form>
