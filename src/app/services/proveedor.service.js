(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .factory('Proveedor', ['$resource', 'API_URL', function($resource, API_URL) {
            return $resource(API_URL+'proveedores/:id', {}, {
                all    : {method: 'GET', isArray: true},
                find   : {method: 'GET', isArray: false}
            });
        }]);

})();
