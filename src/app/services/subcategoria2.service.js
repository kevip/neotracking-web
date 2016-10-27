(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .factory('Subcategoria2', ['$resource', 'API_URL', function($resource, API_URL) {
            return $resource(API_URL+'subcategoria2/:id', {}, {
                all    : {method: 'GET', isArray: true},
                find   : {method: 'GET', isArray: false},
                update : {method: 'PUT', params: {id: '@id'}, isArray: false},
                create : {method: 'POST', isArray: false},
                destroy: {method: 'DELETE', isArray: false}
            });
        }]);

})();
