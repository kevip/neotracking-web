(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('TiendaNewModalController', TiendaNewModalController);

    /** @ngInject */
    TiendaNewModalController.$inject = [
        '$scope',
        'region1',
        'Tienda',
        'tipoTienda',
        'toastr',
        '$http',
        'API_URL',
        '$mdDialog'
    ];

    function TiendaNewModalController($scope, region1, Tienda, tipoTienda, toastr, $http, API_URL, $mdDialog) {
        var vm = this;
        vm.cancel = cancel;
        vm.region1 = region1;
        vm.registrar = registrar;
        vm.saving = false;
        vm.tipoTienda = tipoTienda;
        vm.tienda = {
            ubicacion:{
                region1: null,
                region2: null,
                departamentos: null,
                provincias: null,
                ciudades: null,
                distritos: null
            }
        };
        $scope.$watch('ctrl.tienda.ubicacion.region1', changeRegion1, true);
        $scope.$watch('ctrl.tienda.ubicacion.region2', changeRegion2, true);
        $scope.$watch('ctrl.tienda.ubicacion.departamento_id', changeDepartamento, true);
        $scope.$watch('ctrl.tienda.ubicacion.provincia_id', changeProvincia, true);
        $scope.$watch('ctrl.tienda.ubicacion.ciudad_id', changeCiudad, true);

        function changeRegion1(region1_id){
            vm.tienda.ubicacion.region2 = null;
            vm.region2 = null;
            vm.tienda.ubicacion.departamento_id = null;
            vm.departamentos = null;
            vm.tienda.ubicacion.provincia_id = null;
            vm.provincias = null;
            vm.tienda.ubicacion.ciudad_id = null;
            vm.ciudades = null;
            vm.tienda.ubicacion.distrito_id = null;
            vm.distritos = null;
            $http.get(API_URL+'region2-by-region1',{params:{ "region1_id": region1_id}}).then(
                function success(res){
                    vm.region2 = res.data;
                }
            );
        }

        function changeRegion2(region2_id){
            vm.tienda.ubicacion.departamento_id = null;
            vm.departamentos = null;
            vm.tienda.ubicacion.provincia_id = null;
            vm.provincias = null;
            vm.tienda.ubicacion.ciudad_id = null;
            vm.ciudades = null;
            vm.tienda.ubicacion.distrito_id = null;
            vm.distritos = null;
            $http.get(API_URL+'departamento-by-region2',{params:{ "region2_id": region2_id}}).then(
                function success(res){
                    vm.departamentos = res.data;
                }
            );
        }

        function changeDepartamento(departamento_id){
            vm.tienda.ubicacion.provincia_id = null;
            vm.provincias = null;
            vm.tienda.ubicacion.ciudad_id = null;
            vm.ciudades = null;
            vm.tienda.ubicacion.distrito_id = null;
            vm.distritos = null;
            $http.get(API_URL+'provincia-by-departamento',{params:{ "departamento_id": departamento_id}}).then(
                function success(res){
                    vm.provincias = res.data;
                }
            );
        }

        function changeProvincia(provincia_id){
            vm.tienda.ubicacion.ciudad_id = null;
            vm.ciudades = null;
            vm.tienda.ubicacion.distrito_id = null;
            vm.distritos = null;
            $http.get(API_URL+'ciudad-by-provincia',{params:{ "provincia_id": provincia_id}}).then(
                function success(res){
                    vm.ciudades = res.data;
                }
            );
        }

        function changeCiudad(ciudad_id){
            vm.tienda.ubicacion.distrito_id = null;
            vm.distritos = null;
            $http.get(API_URL+'distrito-by-ciudad',{params:{ "ciudad_id": ciudad_id}}).then(
                function success(res){
                    vm.distritos = res.data;
                }
            );
        }

        $http.get(API_URL+'channel').then(
            function success(res){
                vm.channel = res.data;
            },
            function error(err){
                console.log(err);
            }
        );

        $http.get(API_URL+'retail').then(
            function success(res){
                vm.retail = res.data;
            },
            function error(err){
                console.log(err);
            }
        );

        function cancel(){
            $mdDialog.cancel();
        }

        function registrar(){
            vm.saving = true;
            Tienda.create(vm.tienda,function(res){
                toastr.success("Se registro tienda con éxito");
                $mdDialog.hide();
            },function(err){
                cancel();
                toastr.success("Error al guardar registro");
            });

        }

    }
})();
