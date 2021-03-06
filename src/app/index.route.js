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
                      //añadir parametro 'pagination' para obetener cantidad de items por pagina
                    return Stock.paginate({
                        page: 1
                    }).$promise;

                }]
              },
              module: 'private'
          })
          .state('index.furniture-edit',{
              url: '/furniture/:id/edit',
              templateUrl: 'app/pages/furniture/views/furniture.edit.html',
              controller: 'FurnitureEditController as ctrl',
              resolve: {
                  stock: ['Stock', '$stateParams',function(Stock, $stateParams){
                      return Stock.find({id: $stateParams.id}).$promise;
                  }]

              },
              module: 'private'
          })
          .state('index.furniture-new',{
              url: '/furniture/new',
              templateUrl: 'app/pages/furniture/views/furniture.new.html',
              controller: 'FurnitureNewController as ctrl',
              module: 'private'
          })
          .state('index.furniture-detail',{
              url: '/furniture/:codigo/detail',
              templateUrl: 'app/pages/furniture/views/furniture.detail.html',
              controller: 'FurnitureDetailController as ctrl',
              resolve: {
                  stock: ['Stock', '$stateParams', function(Stock, $stateParams){
                      return Stock.find({id:0, code:$stateParams.codigo}).$promise;
                  }]
              },
              module: 'private'
          })
          .state('index.tracks',{
              url: '/tracks',
              templateUrl: 'app/pages/track/views/tracks.html',
              controller: 'TracksController as ctrl',
              module: 'private',
              resolve: {
                  tracks: ['Track',function(Track){
                      //añadir parametro 'pagination' para obetener cantidad de items por pagina
                      return Track.paginate({
                          page: 1
                      }).$promise;

                  }]
              }
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
