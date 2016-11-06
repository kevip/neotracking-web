(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('LoginController', LoginController);

    /** @ngInject */
    LoginController.$inject = ['authUser'];

    function LoginController(authUser) {
        var vm = this;

        vm.user = {
            email: '',
            password: ''
        };
        vm.login = login;

        function login(e){
            e.preventDefault();
            authUser.loginApi(vm.user);
        }
    }
})();
