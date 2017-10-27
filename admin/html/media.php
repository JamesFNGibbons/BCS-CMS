<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Media And Uploads Center</h2>
      <p>Change / Delete files that have been uploaded to BCS Web Pro
    </div>
  </div>
  <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Files Uploaded
        </div>
        <div class='panel-body'>
          <table class='table table-striped'>
            <th>File Name</th>
            <th>File Link</th>
            <th>Uploaded By</th>
            <th></th>
            <?php foreach($files as $file): ?>
              <tr>
                <td><?php print $file['File_Name']; ?></td>
                <td><?php print $file['File_Path']; ?></td>
                <td><?php print $file['Uploader']; ?></td>
                <td>
                  <form method='post'>
                    <input type='hidden' name='file_id' value='<?php print $file["ID"]; ?>'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='submit' class='btn btn-danger btn-sm' value='Delete'>
                  </form>
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
          Quick Upload New File
        </div>
        <div class='panel-body'>
          <form method='post' enctype="multipart/form-data">
            <div class='form-group'>
              <lable>Select file</lable>
              <input type='file' class='form-control' name='to_upload'>
            </div>
            <div class='form-group'>
              <input type='submit' class='btn btn-primary' value='Upload'>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
