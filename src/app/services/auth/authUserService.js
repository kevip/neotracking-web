/*(function () {
    'use strict';
    angular.module('authService', [])
        .factory('authUser', function ($auth, sessionControl, toastr, $location) {

            var cacheSession = function (email, username, id, avatar) {
                sessionControl.set('userIsLogin', true);
                sessionControl.set('id', id);
                sessionControl.set('email', email);
                sessionControl.set('username', username);
                sessionControl.set('avatar', avatar);
            };
            var unCacheSession = function () {
                sessionControl.unset('userIsLogin');
                sessionControl.unset('id');
                sessionControl.unset('email');
                sessionControl.unset('username');
                sessionControl.unset('avatar');
            };

            var login = function (loginForm) {
                $auth.login(loginForm).then(
                    function (res) {
                        var user = res.data.user;
                        cacheSession(user.email, user.name, user.id, loginForm.avatar)
                        $location.path('/');
                        toastr.success("Bienvenido");
                    },
                    function (err) {
                        toastr.error(err.data.error, 'Error');
                        console.log(err);
                    }
                );
            };


            return {
                loginApi: function (loginForm) {
                    login(loginForm);
                },
                isLoggedIn: function () {
                    return sessionControl.get('userIsLogin') !== null;
                },
                logout: function () {
                    $auth.logout();
                    unCacheSession();
                    console.log("gg");
                    $location.path('/login');
                }
            }
        });
})();*/