(function () {
    'use strict';

    angular
        .module('neotrackingWeb')
        .directive('logout', Logout);

    Logout.$inject = ['authUser', '$state'];

    /* @ngInject */
    function Logout(authUser, $state) {

        var directive = {
            link: link,
            restrict: 'A',
            scope: {}
        };
        return directive;

        function link($scope, element, attrs) {
            element.bind('click', click);

            function click(e) {

                e.preventDefault();
                authUser.logout();
                $state.go('login');
            }
        }
    }

})();

