(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureController', FurnitureController);

    /** @ngInject */

    FurnitureController.$inject = [
        '$mdDialog',
        'stocks',
        '$http',
        'API_URL'
    ];

    function FurnitureController($mdDialog, stocks, $http, API_URL) {
        var vm = this;

        vm.showModalBaja = showModalBaja;
        vm.stock_registros = {
            alta : 0,
            pendientes: 0,
            pendiente_baja : 0,
            baja : 0
        };
        vm.stocks = stocks;

        $http.get(API_URL+'stock-registros').then(function(res){
            vm.stock_registros = res.data;
            vm.stock_registros.pendientes = res.data.pendiente_alta + res.data.pendiente_alta_puede_editar;
        });
        function showModalBaja(e){
            var codigo = $(e.currentTarget).parent().parent().data('codigo');            
            $mdDialog.show({
                controller: BajaMobiliarioModalController,
                controllerAs: 'modal',
                templateUrl: 'app/pages/furniture/views/modals/baja.modal.html',
                locals: {
                    codigo: codigo
                }
            });
        }

        function BajaMobiliarioModalController($http, API_URL, codigo, $mdDialog, toastr){
            var vm = this;
            vm.baja = baja;
            vm.cancel = cancel;

            function baja(){
                $http.put(API_URL+'stock/'+codigo+'/baja',{}).then(
                    function success(res){
                        if(res){
                            toastr.success('Se dió de baja');
                            vm.cancel();
                            location.reload();
                        }
                    },
                    function error(err){
                        toastr.error('Ocurrió algun error, no se pudo dar de baja');
                        console.log(err);
                        vm.cancel();
                    }
                );
            }

            function cancel(){
                $mdDialog.cancel();
            }
        }
    }
})();
