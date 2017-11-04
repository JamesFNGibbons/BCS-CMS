<div class='col-md-2'>
  <div class='thumbnail'>
    <div class='list-group'>
      <?php foreach($admin_sidebar_items as $item): ?>
        <a href='<?php print $item ["Link"]; ?>' class='list-group-item'>
          <i class='<?php print $item["Icon"]; ?>'></i>
          <?php print $item['Title']; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
