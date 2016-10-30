(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UserNewController', UserNewController);

    /** @ngInject */
    UserNewController.$inject = [
        '$http',
        'Rol',
        '$state',
        'User',
        'toastr'
    ];

    function UserNewController($http, Rol, $state, User, toastr) {
        var vm = this;
        vm.roles = Rol.all();
        vm.submit = submit;
        vm.user ={};
        vm.user.rol = 1;
        vm.state = $state.current.name;
        console.log(vm.state);
        function submit(e){
            e.preventDefault();
            User.create(vm.user,function(res){
                toastr.success("Se editó usuario con éxito");
                $state.go('index.users');
            });
            //User.create();
        }

    }
})();
