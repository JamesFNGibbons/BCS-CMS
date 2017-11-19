<div class='col-md-9' ng-app='app' ng-controller='home'>
  <div class='jumbotron'>
    <div class='container'>
      <h2>Device Repairs Overview</h2>
      <p>Quickly view clients, and devices booked in for repair.</p>
    </div>
  </div>
  <?php if(isset($_GET['customer_added'])): ?>
    <div class='alert alert-success'>
      <b><i class='fa fa-check'></i></b>
      The new customer has been added.
      <a href="plugin-view.php?action_id=devrepairs" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  <?php endif; ?>
    <?php if(isset($_GET['customer_deleted'])): ?>
    <div class='alert alert-warning'>
      <b><i class='fa fa-check'></i></b>
      You have deleted a customer.
      <a href="plugin-view.php?action_id=devrepairs" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  <?php endif; ?>
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
  </div>
  <div class='well'>
    <h3>
      Book a new device in for repair
      <a class='btn btn-primary pull-right' href='plugin-view.php?action_id=devrepairs&p=add-order'>
        <i class='fa fa-plus'></i>
        Add Order
      </a>
    </h3>
  </div>
  <div class='row'>
    <div class='col-md-8'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Customers</div>
        <div class='panel-body'>
          <table class='table table-stripped'>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th></th>
            <th></th>
            <tr ng-repeat='customer in customers'>
              <td>{{customer.Name}}</td>
              <td>{{customer.Email}}</td>
              <td>{{customer.Phone}}</td>
              <td>
                <a ng-href='plugin-api.php?api=delete_customer&plugin=Device Repair Order Manager&id={{customer.ID}}' class='text-danger'>
                  Delete
                </a>
              </td>
              <td>
                <a ng-href='plugin-view.php?action_id=devrepairs&p=view_customer&id={{customer.ID}}'>
                  View 
                  <i class='fa fa-search'></i>
                </a>
              </td>
            </tr>
          </table>
        </div>
        <div class='panel-footer'>
          <div class='row'>
            <a href='plugin-view.php?action_id=devrepairs&p=add_customer' class='btn btn-primary pull-right'>
              Add New Customer
              <i class='fa fa-plus'></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'>Devices In For Repair</div>
        <div class='panel-body'>
          <table class='table table-default'>
            <th>Device</th>
            <th>Customer</th>
            <th></th>
            <tr ng-repeat='order in active_orders'>
              <td>{{order.Make}} {{order.Model}}</td>
              <td>{{get_customer(order.Customer).Name}}</td>
              <td>
                <a ng-href='plugin-view.php?action_id=devrepairs&p=view_order&id={{order.ID}}'>
                  View
                  <i class='fa fa-search'></i>
                </a>
              </td>
            </tr>
          </table>
        </div>
        <div class='panel-footer'>
          <div class='row'>
            <a href='plugin-view.php?action_id=devrepairs&p=add_order' class='btn btn-primary pull-right'>
              Add New Order
              <i class='fa fa-plus'></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
