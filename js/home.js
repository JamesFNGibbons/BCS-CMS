angular.module('app').controller('home', function($scope, $http){
  // Load up the customers
  $scope.load_customers = function(){
    $http.get('plugin-api.php?api=get-customers&plugin=Device Repair Order Manager').then(function(data){
      data = data.data;
      $scope.customers = data;
    });

    // Load the active orders.
    $http.get('plugin-api.php?api=get-active-orders&plugin=Device%20Repair%20Order%20Manager').then(function(data){
      data = data.data;
      $scope.active_orders = data;
    });
  }

  /**
    * Function used to get a customers info from id.
    * @param id The customers ID
  */
  $scope.get_customer = function(id){
    for(var i = 0; i < $scope.customers.length; i++){
      if($scope.customers[i].ID = id){
        return $scope.customers[i];
      }
    }
  }

  $scope.load_customers();
  setInterval(function(){
    $scope.$apply(function(){
      $scope.load_customers();
    })
  }, 2000);
});
