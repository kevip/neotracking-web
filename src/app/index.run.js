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

      $rootScope.$on('$stateChangeStart',stateChangeStart);

      function routeChangeStart(){
          if( ($.inArray($location.path(), privateRoutes) !== -1) && !authUser.isLoggedIn()){
              toastr.error("Debe iniciar sesion");
              $location.path('/login');
          }
      }
      function stateChangeStart(e, toState, toParams, fromState, fromParams){
          //if( ($.inArray($location.path(), privateRoutes) !== -1) && !authUser.isLoggedIn()){
          if( toState.module==="private" && !authUser.isLoggedIn()){
              toastr.error("Debe iniciar sesion");
              $location.path('/login');
              //$state.go('login');
          }else if( toState.name==="login" && authUser.isLoggedIn()){
              $location.path('/');
              //$state.go('login');
          }

      }
  }

})();
