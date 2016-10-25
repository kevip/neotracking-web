(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureNewController', FurnitureNewController);

    /** @ngInject */

    FurnitureNewController.$inject = [
        'Stock',
        '$mdDialog'
    ];

    function FurnitureNewController(Stock,$mdDialog) {
        var vm = this;

        vm.showModalAlta = showModalAlta;
        vm.showModalBaja = showModalBaja;
        /*vm.mobiliarios = [
            {
                "codigo":1234324,
                "titulo":"Mueble para TV 42",
                "usuario":987654321,
                "fecha_ingreso":"2016-10-20",
                "image": "http://lorempixel.com/100/120/abstract/img1234324",
                "ubicacion":"Tottus Centro Civico"},
            {
                "codigo":345345,
                "titulo":"Mueble para TV",
                "usuario":981234521,
                "fecha_ingreso":"2016-10-22",
                "image": "http://lorempixel.com/100/120/abstract/img345345",
                "ubicacion":"Plaza Vea Bolichera"}
        ];*/
        vm.mobiliarios = Stock.all();

        function showModalAlta(e){
            var id_usuario = $(e.currentTarget).parent().parent().data('id');
            $mdDialog.show({
                controller: AltaUsuarioModalController,
                controllerAs: 'modal',
                templateUrl: 'app/pages/users/views/modals/alta.modal.html',
                locals: {
                    id: id_usuario
                }
            });

        }

        function showModalBaja(e){
            var id_usuario = $(e.currentTarget).parent().parent().data('id');
            $mdDialog.show({
                controller: BajaUsuarioModalController,
                controllerAs: 'modal',
                templateUrl: 'app/pages/users/views/modals/baja.modal.html',
                locals: {
                    id: id_usuario
                }
            });
        }

        function AltaUsuarioModalController(API_URL, id, $mdDialog, toastr) {
            var vm = this;
            vm.alta = alta;
            vm.cancel = cancel;

            function alta(){
                vm.cancel();
            }

            function cancel(){
                $mdDialog.cancel();
            }

        }

        function BajaUsuarioModalController(API_URL, id, $mdDialog, toastr){
            var vm = this;
            vm.baja = baja;
            vm.cancel = cancel;

            function baja(){
                vm.cancel();
            }

            function cancel(){
                $mdDialog.cancel();
            }
        }
    }
})();
