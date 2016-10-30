(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureController', FurnitureController);

    /** @ngInject */

    FurnitureController.$inject = [
        '$mdDialog',
        'stocks'
    ];

    function FurnitureController($mdDialog, stocks) {
        var vm = this;

        vm.showModalBaja = showModalBaja;

        vm.stocks = stocks;

        function showModalBaja(e){
            var id_mobiliario = $(e.currentTarget).parent().parent().data('id');
            $mdDialog.show({
                controller: BajaMobiliarioModalController,
                controllerAs: 'modal',
                templateUrl: 'app/pages/furniture/views/modals/baja.modal.html',
                locals: {
                    id: id_mobiliario
                }
            });
        }

        function BajaMobiliarioModalController($http, API_URL, id, $mdDialog, toastr){
            var vm = this;
            vm.baja = baja;
            vm.cancel = cancel;

            function baja(){
                $http.put(API_URL+'tracking/'+id+'/baja',{}).then(
                    function success(res){
                        if(res){
                            toastr.success('Se dió de baja');
                            vm.cancel();
                            location.reload();
                        }
                    },
                    function error(err){
                        toastr.error('Ocurrió algun error, no se pudo dar de baja');
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
