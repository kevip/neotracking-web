(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureNewController', FurnitureNewController);

    /** @ngInject */

    FurnitureNewController.$inject = [
        '$mdDialog',
        'stocks',
        'Categoria',
        'Subcategoria1',
        'Subcategoria2'
    ];

    function FurnitureNewController(
        $mdDialog, 
        stocks, 
        Categoria, 
        Subcategoria1, 
        Subcategoria2) {

        var vm = this;
        vm.areas = Categoria.all();
        vm.categorias = Subcategoria1.all();
        vm.subcategorias = Subcategoria2.all();
        
    }
})();
