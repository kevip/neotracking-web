(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .config(config);

  /** @ngInject */
  function config($logProvider, toastrConfig, $httpProvider, $routeProvider, $authProvider) {
    // Enable log
    $logProvider.debugEnabled(true);

    // Set options third-party lib
    toastrConfig.allowHtml = true;
    toastrConfig.timeOut = 3000;
    toastrConfig.positionClass = 'toast-top-right';
    toastrConfig.preventDuplicates = true;
    toastrConfig.progressBar = true;
      $authProvider.loginUrl = "http://localhost:8000/auth_login";
  }

})();
