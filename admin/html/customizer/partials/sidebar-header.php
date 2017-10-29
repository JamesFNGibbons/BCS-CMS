<div class='col-md-3'>
  <div class='page-header'>
    <h3>Customize Your Website</h3>
    <h4 class='text-muted'><?php print $section_title; ?></h4>
  </div>

  <?php if($settings_saved): ?>
    <div class='alert alert-success'>
      Your changes have been saved.
    </div>
  <?php endif; ?>

  <span class='pull-left'>
    <?php if(isset($_GET['section'])): ?>
      <a href='theme-customizer.php'>
        <i class='fa fa-arrow-left'></i> Go Back
      </a>
      <br><br>
    <?php endif; ?>
  </span>

  <span class='pull-right'>
    <a href='index.php'>
      <i class='fa fa-external-link'></i>
      Exit Customizer
    </a>
  </span>

  <br><br>
