<div class='modal fade select_media'>
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
                  <img src='../<?php print $file['File_Path']; ?>' width='100%'>
                  <p class='text-center'><?php print $file['File_Name']; ?></p>
                </div>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
