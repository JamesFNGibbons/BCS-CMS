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
          <div class='panel panel-default'>
            <div class='panel-heading'>Global Settings</div>
            <div class='panel-body'>
              <div class='form-group'>
                <lable>Site Logo</lable>
                <div class='form-control' style='height: 43px;'>
                  <span style='line-height: 30px;' class='pull-left'>
                    <?php print $logo; ?>
                  </span>
                  <span data-toggle='modal' data-target='.modal.select_media' class='btn btn-primary btn-sm pull-right'>
                    Choose Image
                  </span>
                </div>
              </div>
              <div class='form-group'>
                <lable>Site Title</lable>
                <input type='text' name='title' class='form-control' value='<?php print Settings::get("title"); ?>'>
              </div>
              <div class='form-group'>
                <lable>Site Subtitle</lable>
                <input type='text' name='subtitle' class='form-control' value='<?php print Settings::get("subtitle"); ?>'>
              </div>
              <div class='form-group'>
                <lable>Site Url</lable>
                <input type='text' name='url' class='form-control' value='<?php print Settings::get("url"); ?>'>
              </div>
            </div>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='panel panel-default'>
            <div class='panel-heading'>Disable Website Features</div>
            <div class='panel-body'>
              <div class='well'>
                This feature is used to disable the website features
                of the software. This will only enable plugins.
                <div class='form-group'>
                  <label>Disable Website Features</label>
                  <select class='form-control' name='disable-website'>
                    <?php if($disable_site): ?>
                      <option value='true'>True</option>
                      <option value='false'>False</option>
                    <?php else: ?>
                      <option value='false'>False</option>
                      <option value='true'>True</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <i>This feature is for advanced users only.</i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
