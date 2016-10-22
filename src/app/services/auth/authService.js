'use strict';

angular.module('authService',[])
    .factory('sessionControl',function(){
        return {
            get: function(key){
                return sessionStorage.getItem(key);
            },
            set: function(key, val){
                return sessionStorage.setItem(key,val);
            },
            unset: function(key){
                return sessionStorage.removeItem(key);
            }
        }
    })
    .factory('authUser',function($auth, sessionControl, toastr, $location,$log){

        var cacheSession = function(email, username, id, avatar){
            sessionControl.set('userIsLogin', true);
            sessionControl.set('id', id);
            sessionControl.set('email', email);
            sessionControl.set('username', username);
            sessionControl.set('avatar', avatar);
        };
        var unCacheSession = function(){
            sessionControl.unset('userIsLogin');
            sessionControl.unset('id');
            sessionControl.unset('email');
            sessionControl.unset('username');
            sessionControl.unset('avatar');
        };

        var login = function(loginForm){
            $auth.login(loginForm).then(
                function(res){
                    $log.log(res);
                    var user = res.data.user;
                    cacheSession(user.email, user.username,user.id, loginForm.avatar);
                    $location.path('/');
                    toastr.success("Bienvenido");
                },
                function(err){
                    $log.log(err);
                    toastr.error(err.data.error, 'Error');
                }
            );
        };


        return {
            loginApi: function(loginForm){
                login(loginForm);
            },
            isLoggedIn: function(){
                return sessionControl.get('userIsLogin') !== null;
            },
            logout: function(){
                $auth.logout();
                unCacheSession();
                $log.log("gg");
                $location.path('/login');
            }
        }

    })
;