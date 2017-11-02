<div class='col-md-9'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Plugin Manager</h2>
      <p>Additional Software Installed To Extend BCS Web Pro</p>
    </div>
  </div>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      Active Plugins
    </div>
    <div class='panel-body'>
      <table class='table table-stripped'>
        <th>Plugin Name</th>
        <th>Plugin Description</th>
        <th>Plugin Author</th>

        <?php foreach($plugin_manager->active_plugins as $plugin): ?>
          <tr>
            <td><?php print $plugin['Info']->Name; ?></td>
            <td><?php print $plugin['Info']->Description; ?></td>
            <td><?php print $plugin['Info']->Author; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <div class='panel panel-default'>
    <div class='panel-heading'>
      Inactive Plugins
    </div>
    <div class='panel-body'>
      <table class='table table-stripped'>
        <th>Plugin Name</th>
        <th>Plugin Issue</th>

        <?php foreach($plugin_manager->error_plugins as $plugin): ?>
          <tr>
            <td><?php print $plugin['Name']; ?></td>
            <td class='text-danger'><?php print $plugin['Problem']; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
