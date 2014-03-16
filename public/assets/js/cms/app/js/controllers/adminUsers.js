'use strict';

/* Controllers */

angular.module('cms.admin_users', []).
  controller('AdminUsers', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices',
        function($scope, $http, $location, $route, $routeParams, UsersServices) {
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}

            $scope.users = UsersServices.query();
        }]).
  controller('AdminEditUser', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'addAlert', 'alertDisplay',
        function($scope, $http, $location, $route, $routeParams, UsersServices, addAlert, alertDisplay) {
            $scope.alerts = [];
            $scope.alerts_partial = { name: 'alerts', url: '/assets/js/cms/app/partials/alerts.html'}
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.user = {};
            UsersServices.get({uid: $routeParams.uid}, function(data){
                $scope.user = data;
                $scope.breadcrumbs = [
                    {
                        title: "Users",
                        path: "/admin/users"
                    },
                    {
                        title: $scope.user.firstname,
                        path: ''
                    }

                ];
            });
            $scope.updateUser = function() {
                $scope.userCopy = angular.copy($scope.user);
                UsersServices.update({uid: $scope.userCopy.id}, $scope.userCopy, function(data){
                    alertDisplay(data, $scope, "User has been updated...");
                });
            }

        }]).
    controller('AdminUserNew', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'addAlert', 'alertDisplay', 'CSRF_TOKEN',
        function($scope, $http, $location, $route, $routeParams, UsersServices, addAlert, alertDisplay, CSRF_TOKEN) {
            $scope.token = CSRF_TOKEN;
            $scope.alerts = [];
            $scope.alerts_partial = { name: 'alerts', url: '/assets/js/cms/app/partials/alerts.html'}
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.breadcrumbs = [];


            $scope.updateUser = function(user) {
                var params = {
                    "user": user,
                    "_token": CSRF_TOKEN
                }
                UsersServices.create({}, params, function(data, status, headers, config){
                    console.log(status);
                    console.log(headers);
                    console.log(config);
                    console.log(data);
                    //$location.path('/admin');
                    alertDisplay(data, $scope, "User has been saved...");
                });
            }

        }]);