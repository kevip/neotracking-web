(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureDetailController', FurnitureDetailController);

    /** @ngInject */

    FurnitureDetailController.$inject = [];

    function FurnitureDetailController() {
        var vm = this;
        vm.mobiliarios = [
            {
                "codigo":1234324,
                "titulo":"Mueble para TV 42",
                "usuario":987654321,
                "fecha_ingreso":"2016-10-20",
                "ubicacion":"Tottus Centro Civico"},
            {
                "codigo":345345,
                "titulo":"Mueble para TV",
                "usuario":981234521,
                "fecha_ingreso":"2016-10-22",
                "ubicacion":"Plaza Vea Bolichera"}
        ];


    }
})();
