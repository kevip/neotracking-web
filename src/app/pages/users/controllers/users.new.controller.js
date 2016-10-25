(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UserNewController', UserNewController);

    /** @ngInject */
    UserNewController.$inject = [
        '$http',
        '$mdDialog',
        'User'
    ];

    function UserNewController($http, $mdDialog, User) {
        var vm = this;
        vm.showModalAlta = showModalAlta;
        vm.showModalBaja = showModalBaja;

        vm.usuarios = User.all();

        /*vm.usuarios = [
            {"id":1,"nombres":"Juan","apellidos":"Perez","celular":987654321,"fecha_ingreso":"2016-10-20"},
            {"id":2,"nombres":"Maria","apellidos":"Gonzales","celular":981234521,"fecha_ingreso":"2016-10-22"}
        ];*/

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
                $http.put(API_URL+'user/'+id+'/alta',{}).then(
                    function success(res){
                        if(res){
                            //window.location.href = '#/user/new';

                            toastr.success('Se dió de alta');
                            vm.cancel();
                            location.reload();
                        }
                    },
                    function error(err){
                        toastr.error('No se pudo dar de alta');
                        vm.cancel();
                    }
                );
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
                $http.put(API_URL+'user/'+id+'/baja',{}).then(
                    function success(res){
                        if(res){
                            toastr.success('Se dió de baja');
                            vm.cancel();
                            location.reload();

                        }
                    },
                    function error(err){
                        toastr.error('No se pudo dar de baja');
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
