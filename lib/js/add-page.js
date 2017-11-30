angular.module('bcsapp').controller('add-page', function($scope){
  /**
    * Define the default value of the page title.
  */
  $scope.title = new String();

  /**
    * Function used to remove the white
    * spaces from the url.
  */
  $scope.hide_space = function(str){
    if(str !== null){
      return str.split(" ").join("-").toLowerCase();
    }
  }

  /**
    * Function used to save the new page
  */
  $scope.save_page = function(){
    $('form.add-page').submit();
  }
});
