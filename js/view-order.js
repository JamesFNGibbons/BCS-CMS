angular.module('app').controller('view-order', function($scope){
  /**
    * Function used to print a barcode label.
  */
  $scope.print_barcode = function(){
    window.print();
  }
});
