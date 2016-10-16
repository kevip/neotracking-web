(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .run(runBlock);

  /** @ngInject */
  function runBlock($rootScope, $location, authUser, toastr) {
      var privateRoutes = ['/','/admin'];
      $rootScope.$on('$routeChangeStart', routeChangeStart);

      function routeChangeStart(){
          if( ($.inArray($location.path(), privateRoutes) !== -1) && !authUser.isLoggedIn()){
              toastr.error("Debe iniciar sesion");
              $location.path('/login');
          }/*else if( $location.path() == '/login' && authUser.isLoggedIn()){
               *
               * si está logueado no ir a la vista de login!
               *
          }*/
      }
  }

})();
