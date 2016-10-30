(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureNewController', FurnitureNewController);

    /** @ngInject */

    FurnitureNewController.$inject = [
        '$mdDialog',
        'stocks'
    ];

    function FurnitureNewController($mdDialog, stocks) {
    }
})();
