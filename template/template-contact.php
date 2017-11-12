<div class='page-header'>
  <div class='overlay'>
    <div class='container'>
      <br>
      <h1><?php the_title(); ?></h1>
    </div>
  </div>
</div>
<div class='container'>
  <div class='row'>
    <div class='col-md-7'>
      <?php PluginManager::get_plugin('contact-form')->get_form(); ?>
    </div>
    <div class='col-md-5'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Related Pages</div>
        <div class='panel-body'>
          <div class='list-group'>
            <?php foreach(Page::get_pages() as $page): ?>
              <?php if($page['Title'] !== $the_page->title): ?>
                <a class='list-group-item' href='<?php print $page["Uri"]; ?>'>
                  <?php print $page['Title']; ?>
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class='panel panel-default'>
        <div class='panel-heading'>Recent Blog Posts</div>
        <div class='panel-body'>
          <div class='list-group'>
            <?php foreach(Post::get_posts() as $post): ?>
              <a class='list-group-item' href='<?php print $post["Uri"]; ?>'>
                      <?php print $post["Title"]; ?>
                  </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
