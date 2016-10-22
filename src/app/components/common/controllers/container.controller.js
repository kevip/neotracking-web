(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('ContainerController', ContainerController);

    /** @ngInject */
    ContainerController.$inject = [
        '$state',
        '$scope'
    ];

    function ContainerController($state, $scope) {
        var vm = this;
        vm.state =$scope.state= $state.current.name;
    }
})();
