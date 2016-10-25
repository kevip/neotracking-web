(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .run(runBlock);

  /** @ngInject */
  function runBlock($rootScope, $location, authUser, toastr, $state) {
      var privateRoutes = [

          '/',
          '/admin',
          '/furniture/new',
          '/furniture/detail',
          '/users',
          '/user/new'
      ];
      //$rootScope.$on('$routeChangeStart', routeChangeStart);
      $rootScope.$on('$stateChangeStart',stateChangeStart);

      function routeChangeStart(){
          console.log("aa");
          console.log($location.path());
          if( ($.inArray($location.path(), privateRoutes) !== -1) && !authUser.isLoggedIn()){
              toastr.error("Debe iniciar sesion");
              $location.path('/login');
          }
      }
      function stateChangeStart(e, toState, toParams, fromState, fromParams){
          //if( ($.inArray($location.path(), privateRoutes) !== -1) && !authUser.isLoggedIn()){
          if( toState.module==="private" && !authUser.isLoggedIn()){
              console.log("entré");
              toastr.error("Debe iniciar sesion");
              $state.go('login');
          }

      }
  }

})();
