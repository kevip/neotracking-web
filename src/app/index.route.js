(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .config(routeConfig);

  function routeConfig($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/main/main.html',
        controller: 'MainController',
        controllerAs: 'main'
      })
        .when('/login',{
            templateUrl: 'app/pages/login/views/login.html',
            controller: 'LoginController as ctrl'
        })
        .when('/admin', {
            templateUrl: 'app/pages/admin/views/admin.html'
        })
      .otherwise({
        redirectTo: '/'
      });
  }

})();
