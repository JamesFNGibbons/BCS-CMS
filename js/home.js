angular.module('app').controller('home', function($scope, $http){
  // Load up the customers
  $scope.load_customers = function(){
    $http.get('plugin-api.php?api=get-customers&plugin=Device Repair Order Manager').then(function(data){
      data = data.data;
      $scope.customers = data;
    });
  }

  $scope.load_customers();
  setInterval(function(){
    $scope.$apply(function(){
      $scope.load_customers();
    })
  }, 2000);
});
