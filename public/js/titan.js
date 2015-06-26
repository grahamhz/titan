/******************************
titan webapp
Created By: Graham Zuber
for: The University of Utah
Created: 6.18.15
Last Updated: 6.18.15
*******************************/


(function() {

  angular.module('titan', ['ngResource', 'ngRoute'])

  .config(function($routeProvider, $locationProvider) {

/*
    $locationProvider.html5Mode({
      enabled: true,
      requireBase: true
    });
*/

    $locationProvider.hashPrefix('!');


    $routeProvider

      .when('/', { templateUrl: 'public/partials/views/main/main.html',
        controller: 'titanMainCtrl'})

      .when('/login', { templateUrl: 'public/partials/views/account/login.html',
        controller: 'titanLoginCtrl'})

      .otherwise({
        redirectTo: '/'
      });



  });
})();
