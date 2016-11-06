(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureDetailController', FurnitureDetailController);

    /** @ngInject */

    FurnitureDetailController.$inject = [
        '$stateParams',
        '$http',
        'API_URL'
    ];

    function FurnitureDetailController($stateParams, $http, API_URL) {
        var vm = this;
        vm.codigo = $stateParams.codigo;
        $http.get(API_URL+'stock/'+$stateParams.codigo+'/historial').then(
            function(res){
                vm.tracks = res.data;
                console.log(vm.tracks);
            }
        );

    }
})();
