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
              controller: 'ContainerController as ctrl',
              module: 'private'
          })
          .state('index.home',{
              url: '/',
              templateUrl: 'app/pages/home/views/home.html',
              controller: 'HomeController as ctrl',
              resolve: {
                  filtros: ['Filtro', function(Filtro){
                      return Filtro.all().$promise;
                  }]

              },
              module: 'private'
          })
          .state('login',{
              url: '/login',
              templateUrl: 'app/pages/login/views/login.html',
              controller: 'LoginController as ctrl',
              module: 'public'
          })
          .state('index.furniture',{
              url: '/furniture',
              templateUrl: 'app/pages/furniture/views/furniture.html',
              controller: 'FurnitureController as ctrl',
              resolve: {
                  stocks: ['Stock',function(Stock){
                    return Stock.all().$promise;

                }]
              },
              module: 'private'
          })
          .state('index.furniture-new',{
              url: '/furniture/new',
              templateUrl: 'app/pages/furniture/views/furniture.new.html',
              controller: 'FurnitureNewController as ctrl',
              resolve: {
                  stocks: ['Stock',function(Stock){
                    return Stock.all().$promise;
                  }]

              },
              module: 'private'
          })
          .state('index.furniture-detail',{
              url: '/furniture/:codigo/detail',
              templateUrl: 'app/pages/furniture/views/furniture.detail.html',
              controller: 'FurnitureDetailController as ctrl',
              resolve: {
                tracks: ['Stock', '$stateParams', 'API_URL',function(Stock, $stateParams, API_URL){
                    console.log(API_URL+'stock/'+$stateParams.codigo+'/historial');

                    //return Stock.find({id: $stateParams.id});
                }]
              },
              module: 'private'
          })
          .state('index.tracks',{
              url: '/tracks',
              templateUrl: 'app/pages/track/views/tracks.html',
              controller: 'TracksController as ctrl',
              module: 'private'
          })
          .state('index.users',{
              url: '/users',
              templateUrl: 'app/pages/users/views/users.html',
              controller: 'UsersController as ctrl',
              module: 'private'
          })
          .state('index.user-new',{
              url: '/user/new',
              templateUrl: 'app/pages/users/views/users.new.html',
              controller: 'UserNewController as ctrl',
              module: 'private'
          })
          .state('index.user-edit',{
              url: '/user/:id/edit',
              templateUrl: 'app/pages/users/views/users.edit.html',
              controller: 'UserEditController as ctrl',
              resolve: {
                  user: ['User','$stateParams',function(User, $stateParams){
                      return User.find({id: $stateParams.id}).$promise;
                  }]
              },
              module: 'private'
          });
      $urlRouterProvider.otherwise('/login');
  }

})();
