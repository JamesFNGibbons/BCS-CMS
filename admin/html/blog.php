<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Blog Posts</h2>
      <p>Publish / Remove blog posts.</p>
    </div>
  </div>
  <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Published Blog Posts</div>
        <div class='panel-body'>
          <?php if(count($published_posts) > 0): ?>
            <table class='table table-stripped'>
              <th>Post Title</th>
              <th>Published By</th>
              <th></th>
              <th></th>
              <?php foreach($published_posts as $post): ?>
                <tr>
                  <td><?php print $post['Title']; ?></td>
                  <td><?php print $post['Creator']; ?></td>
                  <td>
                    <a href='edit-post.php?post_id=<?php print $post["ID"]; ?>'>
                      Edit Post
                    </a>
                  </td>
                  <td>
                    <a href='blog.php?delete=<?php print $post["ID"]; ?>' class='text-danger'>
                      Delete Post
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          <?php else: ?>
            <h2 class='text-center'>
              No Posts Published.
            </h2>
          <?php endif; ?>
        </div>
      </div>
      <?php if(count($unpublished_posts) > 0): ?>
        <div class='panel panel-default'>
          <div class='panel-heading'>Draft Blog Posts</div>
          <div class='panel-body'>
            <?php if(count($published_posts) > 0): ?>
              <table class='table table-stripped'>
                <th>Post Title</th>
                <th>Published By</th>
                <?php foreach($published_posts as $post): ?>
                  <tr>
                    <td><?php print $post['Title']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </table>
            <?php else: ?>
              <h2 class='text-center'>
                No Posts Drafted.
              </h2>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Quick Add New Post</div>
        <div class='panel-body'>
          <form method='post'>
            <input type='hidden' name='action' value='create'>
            <div class='form-group'>
              <lable>Post Title</lable>
              <input class='form-control' name='title' required>
            </div>
            <div class='form-group'>
              <lable>Post URI</lable>
              <input class='form-control' name='uri' required>
            </div>
            <div class='form-group'>
              <lable>Publish Status</lable>
              <select name='publish' class='form-control'>
                <option value='true'>Published</option>
                <option value='draft'>Draft</option>
              </select>
            </div>
            <div class='form-group'>
              <input type='submit' class='btn btn-primary pull-right' value='Create Post'>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
