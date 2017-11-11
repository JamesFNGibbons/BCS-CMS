<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Edit Post <i>'<font color='white'><?php print $post->title; ?></font>'</i></h2>
    </div>
  </div>
  <form method='post' action='edit-post.php'>
    <input type='hidden' name='id' value='<?php print $post->id; ?>'>
    <input type='hidden' name='action' value='update'>
    <div class='page-header'>
      <a onclick='window.location.assign("blog.php")' class='btn btn-primary'>
        <i class='fa fa-chevron-left'></i>
        Go Back
      </a>
      <input type='submit' class='btn btn-success pull-right' value='Save Changes'>
      <br><br>
    </div>
    <div class='row'>
      <div class='col-md-9'>
        <input class='form-control input-lg' name='title' value='<?php print $post->title; ?>'>
        <br>
        <textarea style='height: 300px;' name='content' class='form-control editor'>
          <?php print $post->content; ?>
        </textarea>
      </div>
      <div class='col-md-3'>
        <div class='panel panel-default'>
          <div class='panel-heading'>
            Quick Actions
          </div>
          <div class='panel-body'>
            <div class='list-group'>
              <a class='list-group-item' href='blog.php?delete=<?php print $post->id; ?>'>
                Delete Post
              </a>
            </div>
          </div>
        </div>
        <div class='panel panel-default'>
          <div class='panel-heading'>Feature Image</div>
          <div class='panel-body'>
            <div class='form-group'>
              <lable>Select Image</lable>
              <div class='form-control' style='height: 43px;'>
                <span style='line-height: 30px;' class='pull-left'>
                  <?php if(!$no_feature_image): ?>
                    <?php print $post->feature_image; ?>
                  <?php else: ?>
                    No Image
                  <?php endif; ?>
                </span>
                <span data-toggle='modal' data-target='.modal.select_media' class='btn btn-primary btn-sm pull-right'>
                  Choose Image
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
