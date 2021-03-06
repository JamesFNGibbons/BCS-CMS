<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Pages</h2>
      <span>
        Quickly create, delete or modify the pages on your website.
      </span>
    </div>
  </div>
  <?php if(isset($creation_error) && $creation_error): ?>
    <div class='alert alert-danger'>
      <b>Error!</b>
      It has not been possible to create the new page at this time.
      <a class='pull-right' href='pages.php'>
        &times;
      </a>
    </div>
  <?php endif; ?>
  <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Existing Pages
        </div>
        <div class='panel-body'>
          <?php if($has_pages): ?>
            <table class='table table-default'>
              <th>Page Title</th>
              <th>Page URI</th>
              <th></th>
              <?php foreach($pages as $page): ?>
                <tr>
                  <td><?php print $page['Title']; ?></td>
                  <td>/<?php print $page['URI']; ?></td>
                  <td>
                    <a href='edit-page.php?id=<?php print $page["ID"]; ?>'>
                      Edit Page
                    </a>
                  </td>
                  <td>
                    <a class='text-danger' href='pages.php?delete=<?php print $page["ID"]; ?>'>
                      Delete Page
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          <?php else: ?>
            <h2 class='text-center'>
              No pages have been created.
            </h2>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class='col-md-3' ng-controller='add-page'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Quick create new page
        </div>
        <div class='pane-body'>
          <div class='well'>
            <form method='post' class='add-page'>
              <div class='form-group'>
                <lable>Page Title</lable>
                <input ng-model='title' type='text' name='title' class='form-control' required>
              </div>
              <div class='form-group'>
                <lable>Page URL</lable>
                <input ng-value='hide_space(title)' type='text' name='uri' class='form-control'>
              </div>
              <div class='form-group'>
                <input type='submit' ng-click='save_page()' class='btn btn-primary form-control' value='Save Page'>
              </div>
            </form>
            <?php if($nav_auto_add): ?>
                <p><i>This page will be added to the navbar automatically.</i>
                 <a href='navigation.php'>Change</a>
                </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
