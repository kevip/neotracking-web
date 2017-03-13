(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('TracksController', TracksController);

    /** @ngInject */
    TracksController.$inject = [
        '$http',
        'tracks',
        'Track',
        '$mdDialog',
        '$scope'
    ];

    function TracksController($http, tracks, Track, $mdDialog, $scope) {
        var vm = this;
        vm.disablePaginator = false;
        vm.showMap = showMap;
        vm.pageChangeHandler = pageChangeHandler;
        vm.refresh = refresh;
        vm.tracks = tracks;
        vm.track={};
        //coordenadas del centro de lima por defecto
        vm.ubicacion = {
            lat: -12.046374,
            lng: -77.0427934
        };

        function errorGetTracks(){
            vm.disablePaginator = false;
        }

        function refresh(){
            Track.paginate({
                page: 1
            }).$promise.then(successGetTracks,errorGetTracks);
        }

        function pageChangeHandler(newPageNumber){
            if(!vm.disablePaginator){
                vm.disablePaginator = true;
                Track.paginate({
                    page: newPageNumber
                }).$promise.then(successGetTracks,errorGetTracks);
            }
        }

        function showMap(track) {
            vm.ubicacion.lat = track.lat;
            vm.ubicacion.lng = track.lng;
        }

        function successGetTracks(response){
            vm.disablePaginator = false;
            vm.tracks = response;
        }

    }
})();
