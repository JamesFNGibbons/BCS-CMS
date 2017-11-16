$(function(){
  if(angular){
    angular.module('admin-core-app', []);
  }
  else{
    throw "Error! Angular is not defined.";
  }
});
