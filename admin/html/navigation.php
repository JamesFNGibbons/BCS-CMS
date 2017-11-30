<script>
$('.priotiry').change(function() {
  $(this).closest('form').submit();
});
</script>
<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Website Navigation</h2>
      <p>Add / Remove navigation items to the navbar</p>
    </div>
  </div>
  <div class='row'>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Add item to navigation
        </div>
        <div class='panel-body'>
          <?php if(count($unadded_pages) > 0): ?>
            <div class='panel panel-default'>
              <div class='panel-heading'>
                Add a page to the navbar
              </div>
              <div class='panel-body'>
                <table class='table'>
                  <?php foreach($unadded_pages as $page): ?>
                    <tr>
                      <td><?php print $page['Title']; ?></td>
                      <td>
                        <form method='post'>
                          <input type='hidden' name='action' value='add_page'>
                          <input type='hidden' name='id' value='<?php print $page["ID"]; ?>'>
                          <input type='submit' class='btn btn-primary btn-sm pull-right' value='Add'>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </table>
                <?php if(Settings::get('navbar-auto-add-pages')): ?>
                  <i>These pages have not been automatically added to the navbar.</i>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
          <div class='panel panel-default'>
            <div class='panel-heading' data-toggle='collapse' data-target='.panel-body.page-settings'>
              <span>Change how pages are added to the navbar</span>
              <i class='fa fa-chevron-down pull-right'></i>
            </div>
            <div class='panel-body collapse page-settings'>
              <form method='post'>
                <input type='hidden' name='action' value='update-autoadd-setting'>
                <div class='form-group'>
                  <lable>How should new pags be added to the navbar?</label>
                  <select name='auto_add_pages' class='form-control'>
                    <?php if(Settings::get('navbar-auto-add-pages') == 'true'): ?>
                      <option value='true'>Automatically</option>
                      <option value='false'>Manually</option>
                    <?php else: ?>
                      <option value='false'>Manually</option>
                      <option value='true'>Automatically</option>
                    <?php endif; ?>
                  </select>
                </div>
                <div class='form-group'>
                  <input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
                </div>
              </form>
            </div>
          </div>
          <div class='panel panel-default'>
            <div data-toggle='collapse' data-target='.text-link-body' class='panel-heading'>
              <span class=''>
                Add Text Based Link
              </span>
              <i class='pull-right fa fa-chevron-down'></i>
            </div>
            <div class='panel-body collapse text-link-body'>
              <form method='post'>
                <input type='hidden' name='action' value='add_item'>
                <div class='form-group'>
                  <label>Link Title</label>
                  <input type='text' name='title' class='form-control'>
                </div>
                <div class='form-group'>
                  <label>Link URL</label>
                  <input type='text' name='link' class='form-control'>
                </div>
                <div class='form-group'>
                  <label>Parent</label>
                  <select name='parent' class='form-control'>
                    <option value='none'>No Parent</option>
                    <?php foreach($parent_items as $item): ?>
                      <option value='<?php print $item["ID"]; ?>'>
                        <?php print $item['Title']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class='form-group' style='margin-top: 10px;'>
                  <input type='submit' class='btn btn-primary pull-right' value='Add To Navbar'>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='col-md-6'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Your Websites Navbar Items
        </div>
        <div class='panel-body'>
          <?php foreach($items as $item): ?>
            <div cass='col-md-4'>
              <div class='panel panel-default'>
                <div data-toggle='collapse' data-target=".panel-body.<?php print $item["ID"]; ?>" class='panel-heading'>
                  <span>
                  <?php if($item['Type'] == 'link'): ?>
                    <?php if(isset($item['Sub_Items'])): ?>
                    Parent Link
                    <?php else: ?>
                    Link
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if(isset($item['Sub_Items'])): ?>
                    Parent Page
                    <?php else: ?>
                    Page
                    <?php endif; ?>
                  <?php endif; ?>
                  <b><?php print $item['Title']; ?></b>
                  </span>
                  <i class='fa fa-chevron-down pull-right'></i>
                </div>
                <div class='panel-body collapse <?php print $item["ID"]; ?>'>
                  <div class='row'>
                    <div class='col-md-4'>
                      <table>
                        <td>Order Priority</td>
                        <td>
                          <form method='post'>
                            <input type='hidden' name='id' value='<?php print $item["ID"]; ?>'>
                            <input type='hidden' name='action' value='update_priority'>
                            <input type='text' name='priority' class='prioritry pull-right' value='<?php print $item["Priority"]; ?>' style='width: 20px;' class='pull-right'>
                          </form>
                        </td>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class='form-group'>
                    <form method='post'>
                      <input type='hidden' name='action' value='update'>
                      <input type='hidden' name='id' value='<?php print $item["ID"]; ?>'>
                      <div class='form-group'>
                        <lable>Link Title</lable>
                        <input type='text' name='title' value='<?php print $item["Title"]; ?>' class='form-control'>
                      </div>
                      <div class='form-group'>
                        <lable>Link Href</lable>
                        <input type='text' name='link' value='<?php print $item["Link"]; ?>' class='form-control'>
                      </div>
                      <div class='form-group'>
                        <lable>Parent Item</lable>
                        <select name='parent' class='form-control'>
                          <?php foreach($parent_items as $parent_item): ?>
                            <?php if($item['Parent'] == $parent_item['ID']): ?>
                              <option value='<?php print $parent_item["ID"]; ?>' selected>
                                <?php print $parent_item["Title"]; ?>
                              </option>
                            <?php else: ?>
                              <option value='<?php print $parent_item["ID"]; ?>'>
                                <?php print $parent_item["Title"]; ?>
                              </option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                          <?php if($parent_item['Parent'] == '0'): ?>
                            <option value='0' selected='selected'>No Parent</option>
                          <?php else: ?>
                            <option value='0'>No Parent</option>
                          <?php endif; ?>
                        </select>
                      </div>
                      <div class='form-group'>
                        <input type='submit' class='btn btn-primary btn-sm pull-right' value='Save Changes'>
                      </div>
                    </form>
                    <div class='form-group'>
                      <form method='post'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='<?php print $item["ID"]; ?>'>
                        <input type='submit' class='btn btn-danger btn-sm' value='Delete Link'>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if(isset($item['Sub_Items'])): ?>
              <?php foreach($item['Sub_Items'] as $sub_item): ?>
                <div class='row'>
                  <div class='col-md-offset-1 col-md-9'>
                    <div class='panel panel-default'>
                      <div class='panel-heading' data-toggle='collapse' data-target='.panel-body.<?php print $sub_item["ID"]; ?>'>
                        <span>
                          Sub Item:
                          <b><?php print $sub_item['Title']; ?></b>
                        </span>
                        <i class='fa fa-chevron-down pull-right'></i>
                      </div>
                      <div class='panel-body collapse <?php print $sub_item["ID"]; ?>'>
                        <div class='form-group'>
                          <form method='post'>
                            <input type='hidden' name='action' value='update'>
                            <input type='hidden' name='id' value='<?php print $sub_item["ID"]; ?>'>
                            <div class='form-group'>
                              <lable>Link Title</lable>
                              <input type='text' name='title' value='<?php print $sub_item["Title"]; ?>' class='form-control'>
                            </div>
                            <div class='form-group'>
                              <lable>Link Href</lable>
                              <input type='text' name='link' value='<?php print $sub_item["Link"]; ?>' class='form-control'>
                            </div>
                            <div class='form-group'>
                              <lable>Parent Item</lable>
                              <select name='parent' class='form-control'>
                                <?php foreach($parent_items as $parent_item): ?>
                                  <?php if($sub_item['Parent'] == $parent_item['ID']): ?>
                                    <option value='<?php print $parent_item["ID"]; ?>' selected>
                                      <?php print $parent_item["Title"]; ?>
                                    </option>
                                  <?php else: ?>
                                    <option value='<?php print $parent_item["ID"]; ?>'>
                                      <?php print $parent_item["Title"]; ?>
                                    </option>
                                  <?php endif; ?>
                                  <?php if($sub_item['Parent'] == '0'): ?>
                                    <option value='0' selected='selected'>No Parent</option>
                                  <?php else: ?>
                                    <option value='0'>No Parent</option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class='form-group'>
                              <input type='submit' class='btn btn-primary btn-sm pull-right' value='Save Changes'>
                            </div>
                          </form>
                          <div class='form-group'>
                            <form method='post'>
                              <input type='hidden' name='action' value='delete'>
                              <input type='hidden' name='id' value='<?php print $sub_item["ID"]; ?>'>
                              <input type='submit' class='btn btn-danger btn-sm' value='Delete Link'>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
