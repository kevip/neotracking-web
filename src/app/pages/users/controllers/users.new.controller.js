(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('UserNewController', UserNewController);

    /** @ngInject */
    UserNewController.$inject = [];

    function UserNewController() {
        var vm = this;

        vm.usuarios = [
            {"id":1,"nombres":"Juan","apellidos":"Perez","celular":987654321,"fecha_ingreso":"2016-10-20"},
            {"id":2,"nombres":"Maria","apellidos":"Gonzales","celular":981234521,"fecha_ingreso":"2016-10-22"}
        ];

        
    }
})();
