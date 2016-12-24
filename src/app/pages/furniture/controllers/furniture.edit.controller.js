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
        'stock'
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
        stock) {

        var vm = this;
        vm.areas = Categoria.all();
        vm.categorias = Subcategoria1.all();
        vm.subcategorias = Subcategoria2.all();
        vm.stock = stock;
        vm.state = $state.current.name;
        vm.submit = submit;
        $http.get(API_URL+'stock/'+vm.stock.codigo+'/last-track').then(
            function success(res){
                vm.track = res.data;
                console.log(vm.track);
            }
        );


        function submit(e){
            e.preventDefault();
            vm.stock.$update(function(res){
                console.log(res);
                $state.go('index.furniture');
                toaster.success('Form saved successfully');

            }, function error(err){
                console.log(err);
            });
        }
    }
})();
