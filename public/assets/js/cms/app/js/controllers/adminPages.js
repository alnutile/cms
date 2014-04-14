'use strict';

/* Controllers */
angular.module('cms.admin_pages', []).
  controller('AdminPages', ['$scope', '$http', '$location', '$route', '$routeParams', 'current_user', 'adminMenu', 'loggedIn', '$window', 'PagesServices', 'alertDisplayJsonResponse',
        function($scope, $http, $location, $route, $routeParams, current_user, adminMenu, loggedIn, $window, PagesServices, alertDisplayJsonResponse) {
            $scope.current_user = current_user;
            $scope.menu = {};
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.help_page = { name: 'help_page', url: '/assets/js/cms/app/partials/shared/help_page.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}
            PagesServices.query(function(data){
                $scope.pages = data;
            });
            $scope.help = {};
            $scope.help.message = "These are the main pages of every site. You can edit them but not delete them no change the URL."

        }]).
    controller('AdminPagesEdit', ['$scope', '$http', '$location', '$route', '$routeParams', 'current_user', 'adminMenu', 'loggedIn', '$window', 'PagesServices', 'addAlert', 'alertDisplayJsonResponse', 'slug',
        function($scope, $http, $location, $route, $routeParams, current_user, adminMenu, loggedIn, $window, PagesServices, addAlert, alertDisplayJsonResponse, slug) {
            $scope.current_user = current_user;
            if(!current_user.data.created_at) {
                $window.location.href = '/login';
            }
            $scope.redactorOptions = {imageUpload: '/api/v1/images', imageGetJson: '/api/v1/gallery'};

            $scope.editorOptions = {
                language: 'en',
                'skin': 'moono',
                'extraPlugins': "imagebrowser,mediaembed",
                imageBrowser_listUrl: '/api/v1/ckeditor/gallery',
                filebrowserBrowseUrl: '/api/v1/ckeditor/files',
                filebrowserImageUploadUrl: '/api/v1/ckeditor/images',
                filebrowserUploadUrl: '/api/v1/ckeditor/files',
                toolbarLocation: 'bottom',
                toolbar: 'full',
                toolbar_full: [
                    { name: 'basicstyles',
                        items: [ 'Bold', 'Italic', 'Strike', 'Underline' ] },
                    { name: 'paragraph', items: [ 'BulletedList', 'NumberedList', 'Blockquote' ] },
                    { name: 'editing', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'tools', items: [ 'SpellChecker', 'Maximize' ] },
                    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
                    { name: 'styles', items: [ 'Format', 'FontSize', 'TextColor', 'PasteText', 'PasteFromWord', 'RemoveFormat' ] },
                    { name: 'insert', items: [ 'Image', 'Table', 'SpecialChar', 'MediaEmbed' ] },'/',
                ]
            };

            $scope.menu = {};
            $scope.bc = { name: 'bc', url: '/assets/js/cms/app/partials/bc.html'}
            $scope.admin_menu_links = { name: 'admin_menu', url: '/assets/js/cms/app/partials/shared/nav_top.html'}
            $scope.help_page = { name: 'help_page', url: '/assets/js/cms/app/partials/shared/help_page.html'}
            $scope.main_links = { name: 'main_links', url: '/assets/js/cms/app/partials/shared/main_links.html'}
            PagesServices.get({pid: $routeParams.pid}, function(data){
                $scope.page = data.data;
                $scope.original = angular.copy($scope.page);
            });
            $scope.page = $scope.page || {};
            $scope.page.content = 'test';

            $scope.help = {};
            $scope.help.message = "Edit and Save the page"
            $scope.alerts = [];
            $scope.alerts_partial = { name: 'alerts', url: '/assets/js/cms/app/partials/alerts.html'}
            $scope.updatePage = function() {
              if($scope.page.slug.indexOf('/') == -1) {
                  addAlert('warning', "The URL must start with /", $scope);
              } else {
                  $scope.page.slug = slug($scope.page.slug);
                  PagesServices.update({pid: $scope.page.id}, $scope.page, function(response, header){
                      if(response.status == 'error') {
                          addAlert('danger', "Error updating page", $scope);
                          alertDisplayJsonResponse(response.data, $scope);
                      } else {
                          var title = response.data.title;
                          addAlert('success', "Page Updated " + title, $scope);
                      }
                  });
              }
            };
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