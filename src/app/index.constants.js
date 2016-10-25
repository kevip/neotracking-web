/* global malarkey:false, moment:false */
(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .constant('malarkey', malarkey)
    .constant('moment', moment)
    .constant('API_URL', 'http://localhost:8000/api/');

})();
