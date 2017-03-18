(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureEditController', FurnitureEditController);

    /** @ngInject */

    FurnitureEditController.$inject = [
        '$mdDialog',
        'Categoria',
        'Subcategoria1',
        'Subcategoria2',
        'Stock',
        'toastr',
        '$state',
        '$http',
        'API_URL',
        'stock',
        'Proveedor'
    ];

    function FurnitureEditController(
        $mdDialog,
        Categoria,
        Subcategoria1,
        Subcategoria2,
        Stock,
        toastr,
        $state,
        $http,
        API_URL,
        stock,
        Proveedor) {

        var vm = this;
        vm.areas = Categoria.all();
        vm.categorias = Subcategoria1.all();
        vm.proveedor = {};
        vm.proveedores = Proveedor.all();
        vm.subcategorias = Subcategoria2.all();
        vm.stock = stock;
        vm.state = $state.current.name;
        vm.submit = submit;


        $http.get(API_URL+'stock/'+vm.stock.codigo+'/last-track').then(
            function success(res){
                vm.track = res.data;
            }
        );


        function submit(e){
            e.preventDefault();
            vm.stock.precio=parseFloat(vm.stock.precio);
            vm.stock.$update(function(res){
                $state.go('index.furniture');
                toastr.success('Form saved successfully');

            }, function error(err){
                console.log(err);
                if(typeof err.data.errors !== 'undefined'){

                    toastr.error("Error de validación, complete todos los campos");
                }

            });
        }
    }
})();
