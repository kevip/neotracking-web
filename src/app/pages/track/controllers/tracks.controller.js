(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('TracksController', TracksController);

    /** @ngInject */
    TracksController.$inject = [
        '$http',
        'Track',
        '$mdDialog',
        '$scope'
    ];

    function TracksController($http, Track, $mdDialog, $scope) {
        var vm = this;
        vm.refresh = refresh;
        vm.showMap = showMap;
        vm.tracks = Track.all();
        vm.track={};
        //coordenadas del centro de lima por defecto
        vm.ubicacion = {
            lat: -12.046374,
            lng: -77.0427934
        };

        function refresh(){
            vm.tracks = Track.all();
        }
        function showMap(track) {
            vm.ubicacion.lat = track.lat;
            vm.ubicacion.lng = track.lng;
            /*$mdDialog.show({
                controller: 'MapModalController',
                controllerAs: 'modal',
                templateUrl: 'app/pages/track/views/modals/map.modal.html',
                locals:{
                    ubicacion: vm.ubicacion
                },
                clickOutsideToClose:true,
                fullscreen: false // Only for -xs, -sm breakpoints.
            })
                .then(function(answer) {
                    console.log(answer);
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function(err) {
                    console.log(err);
                    $scope.status = 'You cancelled the dialog.';
                });
            */
        }

    }
})();
