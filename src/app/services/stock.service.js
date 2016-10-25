(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .factory('Stock', ['$resource', 'API_URL', function($resource, API_URL) {
            return $resource(API_URL+'stock/:id', {}, {
                all    : {method: 'GET', isArray: true},
                find   : {method: 'GET', isArray: false},
                update : {method: 'PUT', params: {id: '@id'}, isArray: false},
                create : {method: 'POST', isArray: false},
                destroy: {method: 'DELETE', isArray: false}
            });
        }]);

})();
