(function() {
    'use strict';

    angular
        .module('neotrackingWeb')
        .factory('Filtro', ['$resource', 'API_URL', function($resource, API_URL) {
            return $resource(API_URL+'filtros/:id', {}, {
                all    : {method: 'GET', isArray: false}
            });
        }]);

})();
