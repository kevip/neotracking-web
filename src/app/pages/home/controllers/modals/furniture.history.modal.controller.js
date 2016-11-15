(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .controller('FurnitureHistory', TiendaNewModalController);

    /** @ngInject */
    TiendaNewModalController.$inject = [
        'codigos',
        '$mdDialog'
    ];

    function TiendaNewModalController(codigos, $mdDialog) {
        var vm = this;
        vm.cancel = cancel;
        vm.codigos = codigos;
        vm.printData = printData;


        function printData()
        {
            var divToPrint=document.getElementById("reporte");
            var newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
        function cancel(){

            $mdDialog.cancel();
        }


    }
})();
