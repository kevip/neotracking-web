(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('HomeController', HomeController);

    /** @ngInject */

    HomeController.$inject = [
        'API_URL',
        '$http',
        'Stock',
        'filtros',
        '$scope',
        '$mdDialog','DTOptionsBuilder', 'DTColumnBuilder',
        '$q',
        'Excel',
        '$timeout',
        'Tienda'
    ];

    function HomeController(
        API_URL,
        $http,
        Stock,
        filtros,
        $scope,
        $mdDialog,DTOptionsBuilder, DTColumnBuilder, $q, Excel, $timeout, Tienda) {

        var vm = this;

        //vm.categorias = categorias;
        vm.abrirHistorial = abrirHistorial;
        vm.filters = {
            categoria: [],
            subcategoria1: [],
            subcategoria2: [],
            region1: [],
            region2: [],
            departamento: [],
            provincia: [],
            tipoTienda: [],
            tiendas: [],
            retail: []
        };
        vm.categorias = filtros.categorias;
        vm.cleanFilters = cleanFilters;
        vm.departamentos = filtros.departamentos;
        vm.dtInstance = {};
        vm.provincias = filtros.provincias;
        vm.region1 = filtros.region1;
        vm.region2 = filtros.region2;
        vm.retails = filtros.retails;
        vm.showItem = showItem;
        vm.showModalNuevaTienda = showModalNuevaTienda;
        //vm.stock = Stock.all().$promise;
        vm.subcategorias1 = filtros.subcategorias1;
        vm.subcategorias2 = filtros.subcategorias2;
        vm.submit = submit;
        vm.sync = sync;
        vm.selected = [];
        vm.tipoTienda = filtros.tipoTienda;
        vm.tiendas = filtros.tiendas;
        vm.total = 0;

        var def = $q.defer();
        def.resolve([]);
        vm.stock = def.promise;

        vm.config = {
            autoHideScrollbar: false,
            theme: 'dark',
            advanced:{
                updateOnContentResize: false
            },
            setHeight: 200,
            scrollInertia: 0
        };
        vm.config_last_checkbox_group = {
            autoHideScrollbar: false,
            theme: 'dark',
            advanced:{
                updateOnContentResize: false
            },
            setHeight: 100,
            scrollInertia: 0
        };

        function dropItem(filter, item){
            if(typeof item == 'undefined'){

                for (var j = 0; j <= filter.length; j++) {
                    filter.splice(j, 1);
                }
            }
            else
            {
                for (var i = 0; i < filter.length; i++) {
                    if (filter[i].id == item.id) {
                        filter.splice(i, 1);
                        break;
                    }
                }
            }
        }

        function showModalNuevaTienda(){
            $mdDialog.show({
                controller: 'TiendaNewModalController',
                controllerAs: 'ctrl',
                fullscrean: true,
                parent: angular.element(document.body),
                templateUrl: 'app/pages/home/views/modals/tienda.new.modal.html',
                locals:{
                    departamentos: vm.departamentos,
                    provincias: vm.provincias,
                    region1: vm.region1,
                    region2: vm.region2,
                    tipoTienda: vm.tipoTienda
                },
                clickOutsideToClose:true

            })
                .then(function(answer) {
                    Tienda.all().$promise.then(function(res){
                        vm.tiendas = res;
                    });
                }, function(err) {
                    $scope.status = 'You cancelled the dialog.';
                });
        }

        function submit(e, sugeridos_baja){
            e.preventDefault();
            var filters = angular.copy(vm.filters);
            filters.sugeridos_baja = '';
            if(sugeridos_baja === 'sugeridos_baja')
                filters.sugeridos_baja = sugeridos_baja;
            $http.post(API_URL+'stock/search',filters).then(function success(response){
                    vm.stocki = response.data;
                    vm.total = 0;
                    for(var i=0;i<response.data.length;i++){
                        vm.total += response.data[i].cantidad;

                    }
            },
            function error(err){
                console.log(err);
            });

        }



        function sync(bool, item, tipo_filtro){
            if(bool){
                if(tipo_filtro == "categoria"){
                    vm.filters.categoria.push(item);
                }else if(tipo_filtro == "subcategoria1"){
                    vm.filters.subcategoria1.push(item);

                }else if(tipo_filtro == "subcategoria2"){
                    vm.filters.subcategoria2.push(item);

                }else if(tipo_filtro == "region1"){
                    vm.filters.region1.push(item);

                }else if(tipo_filtro == "region2"){
                    vm.filters.region2.push(item);

                }else if(tipo_filtro == "departamento"){
                    vm.filters.departamento.push(item);

                }else if(tipo_filtro == "provincia"){
                    vm.filters.provincia.push(item);

                }else if(tipo_filtro == "tipoTienda"){
                    vm.filters.tipoTienda.push(item);

                }else if(tipo_filtro == "tienda"){
                    vm.filters.tiendas.push(item);

                }else if(tipo_filtro == "retail"){
                    vm.filters.retail.push(item);

                }
            }
            else{
                if(tipo_filtro == "categoria"){
                    dropItem(vm.filters.categoria, item);
                }else if(tipo_filtro == "subcategoria1"){
                    dropItem(vm.filters.subcategoria1, item);

                }else if(tipo_filtro == "subcategoria2"){
                    dropItem(vm.filters.subcategoria2, item);

                }else if(tipo_filtro == "region1"){
                    dropItem(vm.filters.region1, item);

                }else if(tipo_filtro == "region2"){
                    dropItem(vm.filters.region2, item);

                }else if(tipo_filtro == "departamento"){
                    dropItem(vm.filters.departamento, item);

                }else if(tipo_filtro == "provincia"){
                    dropItem(vm.filters.provincia, item);

                }else if(tipo_filtro == "tipoTienda"){
                    dropItem(vm.filters.tipoTienda, item);

                }else if(tipo_filtro == "tienda"){
                    dropItem(vm.filters.tiendas, item);

                }else if(tipo_filtro == "retail"){
                    dropItem(vm.filters.retail, item);
                }
            }
        }

        function showItem(item) {
            var name = String(item.name).toUpperCase(),
                searchText = String(vm.searchText).toUpperCase();
            if (item.checked) {
                return true; // Keep element if it is checked
            }

            if (name.includes(searchText)) {
                return true; // Keep element if it matches search text
            }
            return false; // Remove element otherwise

        }
        function cleanFilters(){

            $('.filled-in').attr('checked', false);
            for(var k in vm.filters){
                dropItem(vm.filters[k]);
            }
            for(var k in vm.filters){
                dropItem(vm.filters[k]);
            }

        }
        /*vm.dtOptions = DTOptionsBuilder.fromFnPromise(function() {
            console.log(vm.stock);
                return vm.stock;
            })
            .withDOM('lrtip')
            .withPaginationType('full_numbers')
            .withOption('bFilter', false)
            // Active Buttons extension
            .withButtons([
                'print',
                'excel',
                {
                    text: 'Some button',
                    key: '1',
                    action: function (e, dt, node, config) {
                        alert('Button activated');
                    }
                }
            ]);
        vm.dtColumns = [
            DTColumnBuilder.newColumn('categoria').withTitle('Area'),
            DTColumnBuilder.newColumn('subcategoria1').withTitle('Categoria'),
            DTColumnBuilder.newColumn('subcategoria2').withTitle('Subcategoria'),
            DTColumnBuilder.newColumn('region1').withTitle('Region 1'),
            DTColumnBuilder.newColumn('region2').withTitle('Region 2'),
            DTColumnBuilder.newColumn('departamento').withTitle('Departamento'),
            DTColumnBuilder.newColumn('provincia').withTitle('Provincia'),
            DTColumnBuilder.newColumn('tienda').withTitle('Tienda'),
            DTColumnBuilder.newColumn('tipo_tienda').withTitle('Tipo'),
            DTColumnBuilder.newColumn('retail').withTitle('Retail'),
            DTColumnBuilder.newColumn('cantidad').withTitle('Cantidad')
        ];*/

        $scope.exportToExcel=function(tableId){ // ex: '#my-table'
            var exportHref=Excel.tableToExcel(tableId,'Reporte de Stock');
            $timeout(function(){
                location.href=exportHref;
            },100); // trigger download
        };
        vm.printData = printData;
        function printData(data)
        {
            var divToPrint=document.getElementById(data);
            var htmlToPrint = '' +
                '<style type="text/css">' +
                '#table th, table td {' +
                'border:1px solid #000;' +
                'padding;0.5em;' +
                '}' +
                '.code-img{'+
                'width: 50px;}'+
                '</style>';
            htmlToPrint += divToPrint.outerHTML;
            var newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }


        function abrirHistorial(stock){
            $http.post(API_URL+'stock/codigos', stock).then(function success(response){
                    $mdDialog.show({
                        controller: 'FurnitureHistory',
                        controllerAs: 'ctrl',
                        fullscrean: true,
                        parent: angular.element(document.body),
                        templateUrl: 'app/pages/home/views/modals/furniture.history.modal.html',
                        locals:{
                            codigos: response.data

                        },
                        clickOutsideToClose:true,
                        fullscreen: false // Only for -xs, -sm breakpoints.
                    })
                        .then(function(answer) {
                            $scope.status = 'You said the information was "' + answer + '".';
                        }, function(err) {
                            console.log(err);
                            $scope.status = 'You cancelled the dialog.';
                        });
                },
                function error(err){
                    console.log(err);
                });
    //      //return;

        }
    }
})();
