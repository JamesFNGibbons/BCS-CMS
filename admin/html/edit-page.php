<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Edit Page <i>'<font color='white'><?php print $page->title; ?></font>'</i></h2>
    </div>
  </div>
  <form method='post' action='edit-page.php'>
    <input type='hidden' name='id' value='<?php print $page->id; ?>'>
    <input type='hidden' name='action' value='update'>
    <div class='page-header'>
      <a onclick='window.location.assign("pages.php")' class='btn btn-primary'>
        <i class='fa fa-chevron-left'></i>
        Go Back
      </a>
      <input type='submit' class='btn btn-success pull-right' value='Save Changes'>
      <br><br>
    </div>
    <div class='row'>
      <div class='col-md-9'>
        <input class='form-control input-lg' name='title' value='<?php print $page->title; ?>'>
        <br>
        <textarea style='height: 300px;' name='content' class='form-control editor'>
          <?php print $page->content; ?>
        </textarea>
      </div>
      <div class='col-md-3'>
        <div class='panel panel-default'>
          <div class='panel-heading'>Feature Image</div>
          <div class='panel-body'>
            <div class='form-group'>
              <lable>Site Logo</lable>
              <div class='form-control' style='height: 43px;'>
                <span style='line-height: 30px;' class='pull-left'>
                  <?php print $logo; ?>
                </span>
                <span data-toggle='modal' data-target='.modal.select_media' class='btn btn-primary btn-sm pull-right'>
                  Choose Image
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class='panel panel-default'>
          <div class='panel-heading'>Page SEO Options</div>
          <div class='panel-body'>
            <div class='form-group'>
              <lable>SEO Meta Title</lable>
              <input class='form-control' name='seo.title' value='<?php print $page->get_seo("title"); ?>'>
            </div>
            <div class='form-group'>
              <lable>SEO Meta Description</lable>
              <textarea class='form-control' name='seo.description'><?php print $page->get_seo('description'); ?></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
