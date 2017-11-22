<div class='row' ng-app='app' ng-controller='overview'>
  <div class='col-md-4'>
    <div class='well'>
      <div class='row'>
        <div class='col-md-12'>
          <h1 style='margin: 0; padding: 0;'class='pull-left'><i class='fa fa-users'></i></h1>
          <span class='pull-right'>
            <h2 class='text-right' style='margin: 0; padding: 0;'>{{customers}}</h2>
            <h4>Total Customers</h4>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='well'>
      <div class='row'>
        <div class='col-md-12'>
          <h1 style='margin: 0; padding: 0;'class='pull-left'><i class='fa fa-mobile'></i></h1>
          <span class='pull-right'>
            <h2 class='text-right' style='margin: 0; padding: 0;'>{{customers}}</h2>
            <h4>Devices Being Repaired</h4>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='well'>
      <div class='row'>
        <div class='col-md-12'>
          <h1 style='margin: 0; padding: 0;'class='pull-left'><i class='fa fa-check'></i></h1>
          <span class='pull-right'>
            <h2 class='text-right' style='margin: 0; padding: 0;'>{{customers}}</h2>
            <h4>Devices Repaired</h4>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class='col-md-12'>
    <a class='pull-right' href='plugin-view.php?action_id=devrepairs'>
      View More
      <i class='fa fa-arrow-right'></i>
    </a>
  </div>
</div>
