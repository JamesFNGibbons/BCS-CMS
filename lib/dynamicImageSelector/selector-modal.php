<div class='modal fade select_media <?php print $this->option["Modal-ID"]; ?>'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        Select from uploaded media
      </div>
      <div class='modal-body'>
        <div class='row'>
          <?php foreach(MediaFiles::get_files() as $file): ?>
            <?php if(isset($this->param)): ?>
              <a href='<?php print $this->action; ?>?selected_media=<?php print $file["File_Path"]; ?>&<?php print $this->param; ?>&option=<?php print $this->option["Name"]; ?>'>
                <div class='col-md-3'>
                  <div class='thumbnail'>
                    <img src='../<?php print $file['File_Path']; ?>' width='100%'>
                    <p class='text-center'><?php print $file['File_Name']; ?></p>
                  </div>
                </div>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
          <a href='media.php'>
            <div class='col-md-3'>
              <div class='well'>
                <img src='img/upload.png' width='100%'>
                <p class='text-center'>Upload File</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
