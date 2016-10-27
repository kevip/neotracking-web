(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('HomeController', HomeController);

    /** @ngInject */

    HomeController.$inject = [
        'API_URL',
        'categorias',
        'departamentos',
        'provincias',
        'region1',
        'region2',
        'subcategorias1',
        'subcategorias2',
        '$http',
        'Stock',
        'tipoStock'
    ];

    function HomeController(
        API_URL,
        categorias,
        departamentos,
        provincias,
        region1,
        region2,
        subcategorias1,
        subcategorias2,
        $http,
        Stock,
        tipoStock) {

        var vm = this;

        vm.categorias = categorias;
        vm.filters = {};
        vm.filters.categoria = ['tv','cav','asd'];
        vm.filters.subcategoria = [6,1];
        vm.stock = Stock.all();
        vm.departamentos = departamentos.data;//se llamo con $http
        vm.provincias = provincias.data;//se llamo con $http
        vm.region1 = region1.data;//se llamo con $http
        vm.region2 = region2.data;//se llamo con $http
        vm.subcategorias1 = subcategorias1;
        vm.subcategorias2 = subcategorias2;
        vm.sync = sync;
        vm.tipoStock = tipoStock.data;//se llamo con $http


        function sync(bool, item){
            console.log(bool,item);
            if(bool){


            }
        }
        /*$http({method:"POST",url: API_URL+"stock/search",data:vm.filters}).then(
            function success(response){
                console.log(response);
            },
            function error(err) {
                console.log(err);
            });

        console.log(vm.stock);

        /*$scope.selected = [];

        /*$scope.query = {
            order: 'name',
            limit: 5,
            page: 1
        };

        function success(desserts) {
            $scope.desserts = desserts;
        }

        $scope.getDesserts = function () {
            $scope.promise = $nutrition.desserts.get($scope.query, success).$promise;
        };*/

    }
})();
