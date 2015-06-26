angular.module('titan').controller('titanLoginCtrl', function($scope, $http) {
  //var self = this;
  //self.string = "this is working now!";
  //$scope.teststring = "this is working now!";

  $http.get('api/titan.php/login').success(function(data) {
    $scope.loginstring = data;
  });

  $scope.login = function(unid, password) {
    $http.post('api/titan.php/login', {
      unid: unid,
      password: password
    })

    .success(function(data, status, headers, config) {

    })

    .error(function (data, status, headers, config) {

    });
  };

});
