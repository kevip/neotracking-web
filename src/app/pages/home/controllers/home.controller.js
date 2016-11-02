(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('HomeController', HomeController);

    /** @ngInject */

    HomeController.$inject = [
        'API_URL',
        '$http',
        'Stock',
        'filtros',
        '$scope'
    ];

    function HomeController(
        API_URL,
        $http,
        Stock,
        filtros,
        $scope) {

        var vm = this;

        //vm.categorias = categorias;
        vm.filters = {
            categoria: [],
            subcategoria1: [],
            subcategoria2: [],
            region1: [],
            region2: [],
            departamento: [],
            provincia: [],
            tipoTienda: [],
            tiendas: []
        };
        vm.categorias = filtros.categorias;
        vm.cleanFilters = cleanFilters;
        vm.departamentos = filtros.departamentos;
        vm.provincias = filtros.provincias;
        vm.region1 = filtros.region1;
        vm.region2 = filtros.region2;
        vm.showItem = showItem;
        vm.stock = Stock.all();
        vm.subcategorias1 = filtros.subcategorias1;
        vm.subcategorias2 = filtros.subcategorias2;
        vm.submit = submit;
        vm.sync = sync;
        vm.selected = [];
        vm.tipoTienda = filtros.tipoTienda;
        vm.tiendas = filtros.tiendas;

        vm.config = {
            autoHideScrollbar: false,
            theme: 'dark',
            advanced:{
                updateOnContentResize: false
            },
            setHeight: 200,
            scrollInertia: 0
        };

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
            $http.post(API_URL+'stock/search',vm.filters).then(function success(response){
                vm.stock = response.data;
            },
            function error(err){
                console.log(err);
            });/*
            Stock.search(vm.filters,
                function success(response){
                    vm.stock = response;
                },
                function error(err) {
                    console.log(err);
                }
            );*/

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

                }else if(tipo_filtro == "tipoTienda"){
                    vm.filters.tipoTienda.push(item);

                }else if(tipo_filtro == "tienda"){
                    vm.filters.tiendas.push(item);

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

                }else if(tipo_filtro == "tipoTienda"){
                    dropItem(vm.filters.tipoTienda, item);

                }else if(tipo_filtro == "tienda"){
                    dropItem(vm.filters.tiendas, item);
                }
            }
        }

        function showItem(item) {
            var name = String(item.name).toUpperCase(),
                searchText = String(vm.searchText).toUpperCase();
            if (item.checked) {
                return true; // Keep element if it is checked
            }

            if (name.includes(searchText)) {
                return true; // Keep element if it matches search text
            }
            return false; // Remove element otherwise

        }
        function cleanFilters(){
            for(var key in vm.filters){
                vm.filters[key]=[];
            }
            $('.filled-in').attr('checked', false);
            console.log(vm.filters);
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
