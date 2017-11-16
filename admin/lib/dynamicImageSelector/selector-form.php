<div class='form-group'>
  <div class='form-control' style='height: 43px;'>
    <span style='line-height: 30px;' class='pull-left'>
      <?php print MediaFiles::get_shortname($this->option['Value']); ?>
    </span>
    <span data-toggle='modal' data-target='.modal.select_media.<?php print $this->option["Modal-ID"]; ?>' class='btn btn-primary btn-sm pull-right'>
      Choose Image
    </span>
  </div>
</div>
