(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('TiendaNewModalController', TiendaNewModalController);

    /** @ngInject */
    TiendaNewModalController.$inject = [
        'departamentos',
        'provincias',
        'region1',
        'region2',
        'Tienda',
        'tipoTienda',
        'toastr',
        '$http',
        'API_URL',
        '$mdDialog'
    ];

    function TiendaNewModalController(departamentos, provincias, region1, region2, Tienda, tipoTienda, toastr, $http, API_URL, $mdDialog) {
        var vm = this;
        vm.cancel = cancel;
        vm.departamentos = departamentos;
        vm.provincias = provincias;
        vm.region1 = region1;
        vm.region2 = region2;
        vm.registrar = registrar;
        vm.tipoTienda = tipoTienda;

        $http.get(API_URL+'ciudad').then(
            function success(res){
                vm.ciudades = res.data;
            },
            function error(err){
                console.log(err);
            }
        );

        $http.get(API_URL+'distrito').then(
            function success(res){
                vm.distritos = res.data;
            },
            function error(err){
                console.log(err);
            }
        );

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
            Tienda.create(vm.tienda,function(res){
                console.log(res);
                toastr.success("Se registro tienda con éxito");
                //cancel();
            },function(err){
                toastr.success("Error al guardar registro");
            });

        }

    }
})();
