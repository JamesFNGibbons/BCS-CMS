<div class='modal fade select_media'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        Select from uploaded media
      </div>
      <div class='modal-body'>
        <ul class="nav nav-tabs">
          <?php if(!count(MediaFiles::get_files()) > 0): ?>
            <li><a data-toggle="tab" href="#menu1">Upload Media</a></li>
            <li class='active'><a data-toggle="tab" href="#menu2">Select Media</a></li>
          <?php else: ?>
            <li class='active'><a data-toggle="tab" href="#menu1">Upload Media</a></li>
            <li><a data-toggle="tab" href="#menu2">Select Media</a></li>
          <?php endif; ?>
        </ul>
        <div class="tab-content">
          <div id="menu1" class="tab-pane fade">
            <div class='row'>
              <div class='col-md-6 col-md-offset-3'>
                <div class='thumbnail'>
                  <h2 class='text-center'>Upload Media</h2>
                  <form action='mediauploader.php' method='post' enctype="multipart/form-data">
                    <input type='hidden' name='return' value='<?php print $select_media_action; ?>'>
                    <input type='hidden' name='param' value='<?php print $select_media_param; ?>'>
                    <input type='file' onChange="$(this).closest('form').submit()" name='new_file' class='form-control'>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div id="menu2" class="tab-pane fade">
            <div class='row'>
              <?php foreach(MediaFiles::get_files() as $file): ?>
                <?php if(isset($select_media_param)): ?>
                  <a href='<?php print $select_media_action; ?>?selected_media=<?php print $file["File_Path"]; ?>&<?php print $select_media_param; ?>'>
                    <div class='col-md-3'>
                      <img src='../<?php print $file['File_Path']; ?>' width='100%'>
                      <p class='text-center'><?php print $file['File_Name']; ?></p>
                    </div>
                  </a>
                <?php else: ?>
                  <a href='<?php print $select_media_action; ?>?selected_media=<?php print $file["File_Path"]; ?>'>
                    <div class='col-md-3'>
                      <img src='../<?php print $file['File_Path']; ?>' width='100%'>
                      <p class='text-center'><?php print $file['File_Name']; ?></p>
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
  </div>
</div>
