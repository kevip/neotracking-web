(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('TracksController', TracksController);

    /** @ngInject */
    TracksController.$inject = [
        '$http',
        'Track'
    ];

    function TracksController($http, Track) {
        var vm = this;

        vm.tracks = Track.all();
        console.log(vm.tracks);

    }
})();
