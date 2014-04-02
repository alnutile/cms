angular.module('cms.auth_interceptor', []).
    factory('authInterceptor', ['$rootScope', '$q', '$window', '$location',
        function ($rootScope, $q, $window, $location) {
            return {
                request: function (config) {
                    config.headers = config.headers || {};
                    if ($window.sessionStorage.token) {
                        config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
                    }
                    return config;
                },
                response: function (response) {
                    if (response.status === 401 || response.status == 403) {

                    }
                    return response || $q.when(response);
                },
                responseError: function(rejection) {
                    $window.location.href = '/login';
                    return;

                }
            };
        }]);