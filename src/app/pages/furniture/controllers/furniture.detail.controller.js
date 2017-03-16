(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureDetailController', FurnitureDetailController);

    /** @ngInject */

    FurnitureDetailController.$inject = [
        '$stateParams',
        '$http',
        'API_URL',
        'stock'
    ];

    function FurnitureDetailController($stateParams, $http, API_URL, stock) {
        var vm = this;
        vm.codigo = $stateParams.codigo;
        vm.stock = stock;

        vm.vida_util = getAge(vm.stock.created_at);
        $http.get(API_URL+'stock/'+$stateParams.codigo+'/historial').then(
            function(res){
                vm.tracks = res.data;
            }
        );

        function getAge(data) {
            var now = new Date();
            var date = new Date(data);
            var result = parseInt((now - date) / 365 / 24 / 60 / 60 / 1000);
            return result;
        }

    }
})();
