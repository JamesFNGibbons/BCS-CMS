<div class='list-group'>
  <?php foreach($sections as $section): ?>
    <a href='?section=<?php print $section["Name"]; ?>' class='list-group-item'>
      <?php print $section['Title']; ?>
    </a>
  <?php endforeach; ?>
</div>
