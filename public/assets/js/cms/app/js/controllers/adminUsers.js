'use strict';

/* Controllers */

angular.module('cms.admin_users', []).
  controller('AdminUsers', ['$scope', '$http', '$location', '$route', '$routeParams', 'UsersServices',
        function($scope, $http, $location, $route, $routeParams, UsersServices) {
            $scope.users = UsersServices.query();
            console.log('loaded');
        }]);