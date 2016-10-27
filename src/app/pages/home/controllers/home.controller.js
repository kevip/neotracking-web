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
        vm.filters = {
            categoria: [],
            subcategoria1: [],
            subcategoria2: [],
            region1: [],
            region2: [],
            departamento: [],
            provincia: [],
            tipoStock: []
        };
        vm.stock = Stock.all();
        vm.departamentos = departamentos.data;//se llamo con $http
        vm.provincias = provincias.data;//se llamo con $http
        vm.region1 = region1.data;//se llamo con $http
        vm.region2 = region2.data;//se llamo con $http
        vm.subcategorias1 = subcategorias1;
        vm.subcategorias2 = subcategorias2;
        vm.submit = submit;
        vm.sync = sync;
        vm.tipoStock = tipoStock.data;//se llamo con $http


        function dropItem(filter, item){
            for(var i =0;i<filter.length;i++){
                if(filter[i].id == item.id){
                    filter.splice(i,1);
                    break;
                }
            }
        }

        function submit(e){
            e.preventDefault();
            Stock.search(vm.filters,
                function success(response){
                    vm.stock = response;
                    console.log(vm.stock);
                },
                function error(err) {
                    console.log(err);
                }
            );

        }
        function sync(bool, item, tipo_filtro){
            if(bool){
                if(tipo_filtro == "categoria"){
                    vm.filters.categoria.push(item);
                }else if(tipo_filtro == "subcategoria1"){
                    vm.filters.subcategoria1.push(item);

                }else if(tipo_filtro == "subcategoria2"){
                    vm.filters.subcategoria2.push(item);

                }else if(tipo_filtro == "region1"){
                    vm.filters.region1.push(item);

                }else if(tipo_filtro == "region2"){
                    vm.filters.region2.push(item);

                }else if(tipo_filtro == "departamento"){
                    vm.filters.departamento.push(item);

                }else if(tipo_filtro == "provincia"){
                    vm.filters.provincia.push(item);

                }else if(tipo_filtro == "tipoStock"){
                    vm.filters.tipoStock.push(item);
                }
            }
            else{
                if(tipo_filtro == "categoria"){
                    dropItem(vm.filters.categoria, item);
                }else if(tipo_filtro == "subcategoria1"){
                    dropItem(vm.filters.subcategoria1, item);

                }else if(tipo_filtro == "subcategoria2"){
                    dropItem(vm.filters.subcategoria2, item);

                }else if(tipo_filtro == "region1"){
                    dropItem(vm.filters.region1, item);

                }else if(tipo_filtro == "region2"){
                    dropItem(vm.filters.region2, item);

                }else if(tipo_filtro == "departamento"){
                    dropItem(vm.filters.departamento, item);

                }else if(tipo_filtro == "provincia"){
                    dropItem(vm.filters.provincia, item);

                }else if(tipo_filtro == "tipoStock"){
                    dropItem(vm.filters.tipoStock, item);
                }
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
