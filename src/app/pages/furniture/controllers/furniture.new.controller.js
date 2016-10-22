(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureNewController', FurnitureNewController);

    /** @ngInject */

    FurnitureNewController.$inject = [];

    function FurnitureNewController() {
        var vm = this;
        vm.mobiliarios = [
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
        ];


    }
})();
