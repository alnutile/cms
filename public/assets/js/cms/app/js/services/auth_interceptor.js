angular.module('cms.auth_interceptor', []).
    factory('authInterceptor', ['$rootScope', '$q', '$window', '$location',
        function ($rootScope, $q, $window, $location) {
            return {
            request: function (config) {
                    if ($window.sessionStorage.token) {
                        config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
                    }
                    return config;
                },
                response: function (response) {
                    return response || $q.when(response);
                },
                responseError: function(rejection) {
                    $window.location.href = '/login';
                    return;
                }
            };
        }]);