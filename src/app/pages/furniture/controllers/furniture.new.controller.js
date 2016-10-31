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
        'Subcategoria2',
        'Stock',
        'toastr',
        '$state',
        '$http',
        'API_URL'
    ];

    function FurnitureNewController(
        $mdDialog, 
        stocks, 
        Categoria, 
        Subcategoria1, 
        Subcategoria2,
        Stock,
        toastr,
        $state,
        $http,
        API_URL) {

        var vm = this;
        vm.areas = Categoria.all();
        vm.categorias = Subcategoria1.all();
        vm.subcategorias = Subcategoria2.all();
        console.log(vm.tipoStock);
        vm.stock = {};
        vm.submit = submit;


        $http.get(API_URL+'tipo-stock').then(function(res){
            vm.tipoStock = res.data
        });
        function submit(e){
            e.preventDefault();
            Stock.create(vm.stock,
                function success(res){
                    toastr.success("Se registró mueble con éxito");
                    $state.go('index.furniture');
                },
                function error(error){
                    console.log(error);
                    toastr.error(error);
                }
            );
        }
    }
})();
