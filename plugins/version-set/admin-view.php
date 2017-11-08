<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Set software version</h2>
      <p>A simple plugin used to set the software version in the database, for development</p>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        Set the software version
      </div>
      <div class='panel-body'>
        <form method='post'>
          <div class='input-group'>
            <span class='input-group-addon'>
              Version
            </span>
            <input type='text' name='new_version' class='form-control' value='<?php print Settings::get('software_version'); ?>'>
           </div>
           <div class='form-group'>
             <br>
             <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
           </div>
        </form>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        Current Software Version
      </div>
      <div class='panel-body'>
        <h2 style='margin: 0; padding: 0;'>
          Software Version:
          <?php print Settings::get('software_version'); ?>
      </div>
    </div>
  </div>
</div>
