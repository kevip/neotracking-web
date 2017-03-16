(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureController', FurnitureController);

    /** @ngInject */

    FurnitureController.$inject = [
        '$mdDialog',
        'stocks',
        '$http',
        'API_URL',
        'Stock',
        '$timeout',
        '$scope'
    ];

    function FurnitureController($mdDialog, stocks, $http, API_URL, Stock, $timeout, $scope) {
        var vm = this,
            timeoutPromise;
        vm.pageChangeHandler = pageChangeHandler;
        vm.showModalBaja = showModalBaja;
        vm.stock_registros = {
            alta : 0,
            pendientes: 0,
            pendiente_baja : 0,
            baja : 0
        };
        vm.stocks = stocks;
        vm.disablePaginator = false;

        $http.get(API_URL+'stock-registros').then(function(res){
            vm.stock_registros = res.data;
            vm.stock_registros.pendientes = res.data.pendiente_alta + res.data.pendiente_alta_puede_editar;
        });

        $scope.$watch('ctrl.keyword', searchFurniture, true);

        function pageChangeHandler(newPageNumber, e){
            if(!vm.disablePaginator){
                vm.disablePaginator = true;
                Stock.paginate({
                    page: newPageNumber,
                    keyword:vm.keyword
                }).$promise.then(successGetStock,errorGetStock);
            }
        }

        function errorGetStock(){
            vm.disablePaginator = false;
        }

        /**
         * This method makes an http call to users for every keyup and there's a delay of 800ms for every request,
         * if a new http request is called before 800ms the last request is canceled
         * @param keyword
         * @param oldKeyword
         */
        function searchFurniture(keyword, oldKeyword){
            //@TODO Create directive so you dont have to reuse this code
            $timeout.cancel(timeoutPromise);
            timeoutPromise = $timeout(function() {
                if(typeof keyword !== 'undefined'){
                    if(keyword.length>=3){
                        Stock.paginate({
                            page: 1,
                            keyword:vm.keyword
                        }).$promise.then(successGetStock,errorGetStock);
                    }else if(typeof oldKeyword!=="undefined") {
                        if(keyword.length<oldKeyword.length && keyword.length<3) {
                            Stock.paginate({
                                page: 1
                            }).$promise.then(successGetStock,errorGetStock);
                        }
                    }
                }
            }, 500);
        }

        function showModalBaja(e){
            var codigo = $(e.currentTarget).parent().parent().data('codigo');            
            $mdDialog.show({
                controller: BajaMobiliarioModalController,
                controllerAs: 'modal',
                templateUrl: 'app/pages/furniture/views/modals/baja.modal.html',
                locals: {
                    codigo: codigo
                }
            });
        }

        function successGetStock(response){
            vm.disablePaginator = false;
            vm.stocks = response;
        }

        function BajaMobiliarioModalController($http, API_URL, codigo, $mdDialog, toastr){
            var vm = this;
            vm.baja = baja;
            vm.cancel = cancel;

            function baja(){
                $http.put(API_URL+'stock/'+codigo+'/baja',{}).then(
                    function success(res){
                        if(res){
                            toastr.success('Se dió de baja');
                            vm.cancel();
                            location.reload();
                        }
                    },
                    function error(err){
                        toastr.error('Ocurrió algun error, no se pudo dar de baja');
                        console.log(err);
                        vm.cancel();
                    }
                );
            }

            function cancel(){
                $mdDialog.cancel();
            }
        }
    }
})();
