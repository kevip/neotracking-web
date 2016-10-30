(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UserEditController', UserEditController);

    /** @ngInject */
    UserEditController.$inject = [
        'user',
        '$state',
        'Rol',
        'User',
        'toastr'
    ];

    function UserEditController(user, $state, Rol, User, toastr) {
        var vm = this;
        vm.getSelectedText = getSelectedText;
        vm.roles = Rol.all();
        vm.submit = submit;
        vm.user = user;

        angular.forEach(user.roles,function(value, key){
           vm.user.rol = value.id;
        });

        function getSelectedText() {
            if (vm.user.rol!== undefined) {
                return vm.user.rol;
            } else {
                return "Seleccione un rol";
            }
        }

        function submit(e){
            e.preventDefault();
            User.update({id:vm.user.id},vm.user,function(res){
                if(res){
                    toastr.success("Se editó usuario con éxito");
                    $state.go('index.users');
                }
            },function(err){
                console.log(err);
            });
        }
    }
})();
