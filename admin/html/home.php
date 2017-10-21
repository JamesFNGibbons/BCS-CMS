<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Welcome, <?php print $user->get_name(); ?></h2>
      <span>Not you? (<a href='logout.php'>Sign Out</a>)</span>
    </div>
  </div>
  <div class='row'>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          What do you want to do?
        </div>
        <div class='panel-body'>

        </div>
      </div>
    </div>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          About your website
        </div>
        <div class='panel-body'>

        </div>
      </div>
    </div>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          Recent news from Bespoke Computer Software
        </div>
        <div class='panel-body'>
          <?php foreach($recent_news as $news): ?>
            <div class='list-group'>
              <a class='list-group-item'>
                
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
