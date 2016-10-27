(function() {
  'use strict';

  angular
    .module('neotrackingWeb', [
          'authService',
          'ngCookies',
          'ngSanitize',
          'ngMessages',
          'ngAria',
          'ngResource',
          'ngRoute',
          'ngMaterial',
          'ui.router',
          'toastr',
          'satellizer',
          'md.data.table'
      ]);

})();
