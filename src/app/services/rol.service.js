(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .factory('Rol', ['$resource', 'API_URL', function($resource, API_URL) {
            return $resource(API_URL+'rol/:id', {}, {
                all    : {method: 'GET', isArray: true},
                find   : {method: 'GET', isArray: false}
            });
        }]);

})();
