angular.module('titan').controller('titanMainCtrl', function($scope, $http) {
  //var self = this;
  //self.string = "this is working now!";
  //$scope.teststring = "this is working now!";

  $http.get('api/titan.php/main').success(function(data) {
    $scope.mainstring = data;
  });

});
