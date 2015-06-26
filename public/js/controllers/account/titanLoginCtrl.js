angular.module('titan').controller('titanLoginCtrl', function($rootScope, $scope, $http, $cookies) {

  $scope.login = function(unid, password) {
    $http.post('api/titan.php/login', {
      unid: unid,
      password: password
    })
    .success(function(data, status, headers, config) {
      
      $cookies.put("titan_token", data.token);
      $cookies.put("titan_unid", data.unid);
      $rootScope.user = data;
    })
    .error(function (data, status, headers, config) {

    });
  };

});
