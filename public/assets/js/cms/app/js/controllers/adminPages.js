'use strict';

/* Controllers */
angular.module('cms.admin_pages', []).
  controller('AdminPages', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'current_user', 'adminMenu', 'loggedIn', '$window',
        function($scope, $http, $location, $route, $routeParams, UsersServices, current_user, adminMenu, loggedIn, $window) {
            $scope.current_user = current_user;
            $scope.menu = {};
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}

        }]).
    controller('AdminDash', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices', 'current_user', 'adminMenu', 'loggedIn', '$window',
        function($scope, $http, $location, $route, $routeParams, UsersServices, current_user, adminMenu, loggedIn, $window) {
            $scope.current_user = current_user;
            if(!current_user.data.created_at) {
                $window.location.href = '/login';
            }
            $scope.menu = {};
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}

        }]);