<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 footerleft ">
      <div class="logofooter"><?php the_site_title(); ?></div>
        <p><?php print get_theme_option('footer:about'); ?></p>
      </div>
      <div class="col-md-2 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">GENERAL LINKS</h6>
        <ul class="footer-ul">
            <?php foreach(Page::get_pages(2) as $page): ?>
                <li>
                    <a href='<?php print $page["Uri"]; ?>'>
                        <?php print $page['Title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>        
        </ul> 
       </div>
      <div class="col-md-3 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">LATEST POST</h6>
        <div class="post">
            <?php $post = Post::get_latest_post(); ?>
            <?php if(!empty($post)): ?>
                <p>
                    <?php print $post['Title']; ?>
                    <span><a href='<?php print $post["Uri"]; ?>'>
                        View Post  
                    </a></span>
                </p>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer start from here-->
<div class="copyright">
  <div class="container">
    <div class="col-md-6">
      <p>© 20<?php print Date('y'); ?> - <?php the_site_title(); ?></p>
    </div>
    <div class="col-md-6">
        <p>
            Website Created And Powered By -  
            <a href='http://bespokecomputersoftware.co.uk'>
                Bespoke Computer Software 
            </a>
        </p>
    </div>
  </div>
</div>
