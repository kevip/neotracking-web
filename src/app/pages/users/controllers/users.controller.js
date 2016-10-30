(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UsersController', UsersController);

    /** @ngInject */
    UsersController.$inject = [
        '$http',
        '$mdDialog',
        'User'
    ];

    function UsersController($http, $mdDialog, User) {
        var vm = this;
        vm.showModalAlta = showModalAlta;
        vm.showModalBaja = showModalBaja;

        vm.usuarios = User.all();

        function showModalAlta(e){
            var id_usuario = $(e.currentTarget).parent().parent().parent().data('id');
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
            var id_usuario = $(e.currentTarget).parent().parent().parent().data('id');
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

