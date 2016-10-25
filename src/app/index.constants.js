/* global malarkey:false, moment:false */
(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .constant('malarkey', malarkey)
    .constant('moment', moment)
    .constant('API_URL', 'http://www.neoprojects.com.pe/neotracking-web/public/api/');

})();
