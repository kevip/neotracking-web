(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UsersController', UsersController);

    /** @ngInject */
    UsersController.$inject = [
        '$http',
        'User'
    ];

    function UsersController($http, User) {
        var vm = this;

        vm.usuarios = [
            {"id":1,"nombres":"Juan","apellidos":"Perez","celular":987654321,"fecha_ingreso":"2016-10-20"},
            {"id":2,"nombres":"Maria","apellidos":"Gonzales","celular":981234521,"fecha_ingreso":"2016-10-22"}
        ];

        vm.usuarios = User.all();


    }
})();

