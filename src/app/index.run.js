(function() {
  'use strict';

  angular
    .module('neotrackingWeb')
    .run(runBlock);

  /** @ngInject */
  function runBlock($log) {

    $log.debug('runBlock end');
  }

})();
