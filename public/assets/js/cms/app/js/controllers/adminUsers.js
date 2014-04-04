'use strict';

/* Controllers */

angular.module('cms.admin_users', []).
  controller('AdminUsers', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'current_user', 'adminMenu', 'loggedIn',
        function($scope, $http, $location, $route, $routeParams, UsersServices, current_user, adminMenu, loggedIn) {
            $scope.current_user = current_user;
            $scope.menu = {};
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}
            UsersServices.query(function(data){
                $scope.users = data;
            });
        }]).
  controller('AdminEditUser', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'addAlert', 'alertDisplay', 'current_user',
        function($scope, $http, $location, $route, $routeParams, UsersServices, addAlert, alertDisplay, current_user) {
            $scope.current_user = current_user;

            if($scope.current_user.data.admin != 1) {
                console.log('You are not admin');
            }
            $scope.alerts = [];
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.user = {};
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}

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
                $scope.alerts_partial = { name: 'alerts', url: '/assets/js/cms/app/partials/alerts.html'}
            });
            $scope.updateUser = function() {
                $scope.userCopy = angular.copy($scope.user);
                UsersServices.update({uid: $scope.userCopy.id}, $scope.userCopy, function(data){
                    alertDisplay(data, $scope, "User has been updated...");
                });
            }

        }]).
    controller('AdminUserNew', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'addAlert', 'alertDisplay', 'CSRF_TOKEN', 'current_user',
        function($scope, $http, $location, $route, $routeParams, UsersServices, addAlert, alertDisplay, CSRF_TOKEN, current_user) {
            $scope.current_user = current_user;

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
                    alertDisplay(data, $scope, "User has been saved...");
                    if ( data.error == 0 ) {
                        $location.path('/admin');
                        alertDisplay(data, $scope, "User has been saved...");
                    }
                });
            }

        }]);