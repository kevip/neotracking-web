(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .config(routeConfig);

  function routeConfig($routeProvider,$stateProvider, $urlRouterProvider) {
      $stateProvider
          .state('index',{
              abstract: true,
              url: '',
              templateUrl: 'app/components/common/container.html',
              controller: 'ContainerController as ctrl'
          })
          .state('index.home',{
              url: '/',
              templateUrl: 'app/pages/home/views/home.html',
              controller: 'HomeController as ctrl'
          })
          .state('login',{
              url: '/login',
              templateUrl: 'app/pages/login/views/login.html',
              controller: 'LoginController as ctrl'
          })
          .state('index.furniture',{
              url: '/furniture/new',
              templateUrl: 'app/pages/furniture/views/furniture.new.html',
              controller: 'FurnitureNewController as ctrl'
          })
          .state('index.furniture-detail',{
              url: '/furniture/detail',
              templateUrl: 'app/pages/furniture/views/furniture.detail.html',
              controller: 'FurnitureDetailController as ctrl'
          })
          .state('index.users',{
              url: '/users',
              templateUrl: 'app/pages/users/views/users.html',
              controller: 'UsersController as ctrl'
          })
          .state('index.user-new',{
              url: '/user/new',
              templateUrl: 'app/pages/users/views/users.new.html',
              controller: 'UserNewController as ctrl'
          });
      $urlRouterProvider.otherwise('/login');
  }

})();
