angular.module('app').config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
}]);

angular.module('app').controller('overview', function($scope, $http){
  $scope.update = function(){
    // Get the customers.
    $http.get('plugin-api.php?api=count-customers&plugin=Device Repair Order Manager').then(function(data){
      data = data.data;
      $scope.customers = data;
    });

    // Load the active orders.
    $http.get('http://localhost/jas-cms/admin/plugin-api.php?api=get-active-orders&plugin=Device%20Repair%20Order%20Manager').then(function(data){
      data = data.data;
      $scope.active_orders_count = data.length;
    });

    // Get the Number of deviced booked in.
    $http.get('plugin-api.php?api=count-customers&plugin=Device Repair Order Manager').then(function(data){
      data = data.data;
      $scope.customers = data;
    });
  }

  $scope.update();
  setInterval(function(){
    $scope.update();
  }, 2000);
});
