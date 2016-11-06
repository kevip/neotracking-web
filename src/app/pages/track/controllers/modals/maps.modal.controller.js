(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('MapModalController', MapModalController);

    /** @ngInject */
    MapModalController.$inject = [
        'ubicacion'
    ];

    function MapModalController(ubicacion) {
        var vm = this;
        console.log(ubicacion);
        vm.lat = ubicacion.lat;
        vm.lng = ubicacion.lng;

    }
})();
