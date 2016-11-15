(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureNewController', FurnitureNewController);

    /** @ngInject */

    FurnitureNewController.$inject = [
        'Categoria',
        'Subcategoria1',
        'Subcategoria2',
        'toastr',
        '$state',
        '$http',
        'API_URL'
    ];

    function FurnitureNewController(
        Categoria, 
        Subcategoria1, 
        Subcategoria2,
        toastr,
        $state,
        $http,
        API_URL) {

        var vm = this;
        vm.areas = Categoria.all();
        vm.categorias = Subcategoria1.all();
        vm.mobiliario = {};
        vm.subcategorias = Subcategoria2.all();
        vm.stock = {};
        vm.state = $state.current.name;
        vm.submit = submit;
        vm.selectOnMatch = true;

        function submit(e){
            /**/
            e.preventDefault();
            var mobiliario={};
            if(vm.searchArea && vm.searchCategoria && vm.searchSubCategoria){
                mobiliario.categoria = vm.mobiliario.categoria?vm.mobiliario.categoria:vm.searchArea.toUpperCase();
                mobiliario.subcategoria1 = vm.mobiliario.subcategoria1?vm.mobiliario.subcategoria1:vm.searchCategoria.toUpperCase();
                mobiliario.subcategoria2 = vm.mobiliario.subcategoria2?vm.mobiliario.subcategoria2:vm.searchSubCategoria.toUpperCase();
                console.log(mobiliario);
                $http.post(API_URL+'mobiliario',mobiliario).then(
                    function success(res){
                        toastr.success('Se creó mobiliario con éxito!');
                        $state.go('index.furniture');
                    },
                    function error(err){
                        toastr.error('No se pudo crear mobiliario');
                    }
                );
            }else {
                toastr.warning('Debe completar todos los campos');
            }
        }
    }
})();
