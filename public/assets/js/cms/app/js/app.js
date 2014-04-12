'use strict';


// Declare app level module which depends on filters, and services
angular.module('cms', [
        'ngRoute',
        'ngSanitize',
        'angular-redactor',
        'cms.alertServices',
        'cms.usersServices',
        'cms.admin_users',
        'cms.auth_interceptor',
        'cms.admin_pages',
        'cms.current_user',
        'cms.pagesService',
        'cms.helpers',
        'cms.filters',
        'cms.admin_menu'
    ]).
    config(['$routeProvider', '$locationProvider', '$httpProvider', function($routeProvider, $locationProvider, $httpProvider) {

        $httpProvider.interceptors.push('authInterceptor');

        $locationProvider.html5Mode(true);
        $routeProvider.when('/admin', {
                templateUrl: '/assets/js/cms/app/partials/admin/admin_dash.html',
                controller: 'AdminDash',
                resolve: {
                    current_user: function(currentUser) {
                        return  currentUser();
                    }
                }
            }
        );
        $routeProvider.when('/admin/pages', {
            templateUrl: '/assets/js/cms/app/partials/admin/pages/pages_index.html',
            controller: 'AdminPages',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.when('/admin/pages/:pid/edit', {
            templateUrl: '/assets/js/cms/app/partials/admin/pages/edit.html',
            controller: 'AdminPagesEdit',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.when('/admin/users', {
            templateUrl: '/assets/js/cms/app/partials/admin/users/users_index.html',
            controller: 'AdminUsers',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.when('/admin/users/new', {
            templateUrl: '/assets/js/cms/app/partials/admin/users/users_create.html',
            controller: 'AdminUserNew',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.when('/admin/users/:uid/edit', {
            templateUrl: '/assets/js/cms/app/partials/admin/users/users_edit.html',
            controller: 'AdminEditUser',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.when('/pages', {
            templateUrl: '/assets/js/cms/app/partials/admin/pages/pages_index.html',
            controller: 'AdminPages',
            resolve: {
                current_user: function(currentUser) {
                    return  currentUser();
                }
            }
        });
        $routeProvider.otherwise({
            redirectTo: '/admin'
        });
    }]).
    run(['currentUser', 'adminMenu', function(currentUser, adminMenu){
        adminMenu();

    }]);