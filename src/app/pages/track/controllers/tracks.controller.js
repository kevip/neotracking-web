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
        '$scope',
        '$timeout'
    ];

    function TracksController($http, tracks, Track, $mdDialog, $scope, $timeout) {
        var vm = this,
            timeoutPromise;
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

        $scope.$watch('ctrl.keyword', searchTrack, true);

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
                    page: newPageNumber,
                    keyword:vm.keyword
                }).$promise.then(successGetTracks,errorGetTracks);
            }
        }

        /**
         * This method makes an http call to users for every keyup and there's a delay of 800ms for every request,
         * if a new http request is called before 800ms the last request is canceled
         * @param keyword
         * @param oldKeyword
         */
        function searchTrack(keyword, oldKeyword){
            //@TODO Create directive so you dont have to reuse this code
            $timeout.cancel(timeoutPromise);
            timeoutPromise = $timeout(function() {
                if(typeof keyword !== 'undefined'){
                    if(keyword.length>=3){
                        Track.paginate({
                            page: 1,
                            keyword:vm.keyword
                        }).$promise.then(successGetTracks,errorGetTracks);
                    }else if(typeof oldKeyword!=="undefined") {
                        if(keyword.length<oldKeyword.length && keyword.length<3) {
                            Track.paginate({
                                page: 1
                            }).$promise.then(successGetTracks,errorGetTracks);
                        }
                    }
                }
            }, 500);
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
