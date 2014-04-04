angular.module('cms.current_user', [])
    .factory('currentUser', ['$http', 'loggedIn',
        function($http, loggedIn){
            return function() {
                    var currentUserPromise = $http.get('/api/v1/current_user');
                    currentUserPromise.then(function(response){
                        var current_user = response.data;
                        loggedIn(current_user);
                        if(!current_user.admin) {
                            current_user.admin = 0;
                        }
                    }, function(response){
                            var current_user = {};
                            loggedIn(current_user);
                            throw new Error('Could not get Current Use from Server Error: ' + response.status );
                    });
                    return currentUserPromise;
            }
    }])
    .factory('loggedIn', ['$rootScope',
        function($rootScope){
            return function(current_user) {
                if(current_user.created_at) {
                    $rootScope.loggedIn = 1;
                } else {
                    $rootScope.loggedIn = 0;
                }
            }
    }]);