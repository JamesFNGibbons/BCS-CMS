<div class='col-md-2'>
  <div class='thumbnail'>
    <div class='list-group'>
      <?php foreach($admin_sidebar_items as $item): ?>
        <?php if($item['Type'] == 'static'): ?>
          <a href='<?php print $item ["Link"]; ?>' class='list-group-item'>
            <i class='<?php print $item["Icon"]; ?>'></i>
            <?php print $item['Title']; ?>
          </a>
        <?php else: ?>
          <a href='plugin-view.php?action_id=<?php print $item["Action_ID"]; ?>' class='list-group-item'>
            <i class='<?php print $item["Icon"]; ?>'></i>
            <?php print $item['Title']; ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
