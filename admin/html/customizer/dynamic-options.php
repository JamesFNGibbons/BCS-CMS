<div class='list-group'>
  <?php foreach($sub_sections as $sect): ?>
    <a href='theme-customizer.php?section=<?php print $sect["Name"]; ?>' class='list-group-item'>
      <?php print $sect['Title']; ?>
    </a>
  <?php endforeach; ?>
</div>

<form action='theme-customizer.php?section=<?php print $section; ?>' method='post'>
  <input type='hidden' name='action' value='update'>
  <?php foreach($options as $option): ?>
    <div class='form-group'>
      <lable><?php print $option['Label']; ?></lable>
      <?php if($option['Type'] == 'text'): ?>
        <input class='form-control' name='<?php print $option["Name"]; ?>' value='<?php print $option["Value"]; ?>'>
      <?php endif; ?>
      <?php if($option['Type'] == 'image'): ?>
        <?php $selector = new DynamicImageSelector('theme-customizer.php', "section=$section", $option); ?>
        <?php $selector->get_selector(); ?>
      <?php endif; ?>
      <?php if($option['Type'] == 'textarea'): ?>
        <textarea name='<?php print $option["Name"]; ?>' class='form-control'><?php print $option['Value']; ?></textarea>
      <?php endif; ?>
      <?php if($option['Type'] == 'select'): ?>
        <select name='<?php print $option["Name"]; ?>' class='form-control'>
          <?php foreach(SelectOption::get_options($option["Name"]) as $select_option): ?>
            <?php if($select_option['Value'] == $option['Value']): ?>
              <option selected='selected' value='<?php print $select_option["Value"]; ?>'>
                <?php print $select_option["Title"]; ?>
              </option>
            <?php else: ?>
              <option value='<?php print $select_option["Value"]; ?>'>
                <?php print $select_option["Title"]; ?>
              </option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
  <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
</form>
