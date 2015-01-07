var tagsCtrl = angular.module('tagsCtrl', []);

tagsCtrl.controller('tagsCtrl', ['$scope', 'Restangular', '$window',
    function($scope, Restangular, $window) {
        $scope.pageId   = false;

        $scope.getPageInfo = function()
        {
            var path = $window.location.pathname;
            path_array = path.split('/');
            if(path_array.indexOf('edit') !== -1) {
                $scope.pageId   = path_array[2];
                var model   = path_array[1];
                if(model === 'projects'){
                    $scope.model = 'Project';
                }else if(model === 'posts'){
                    $scope.model = 'Post';
                }
            }
        }

        $scope.addTag = function(tag)
        {
            var rest =  Restangular.all('api/v1/tags');
            rest.data = {};
            rest.data.tag = tag.text;
            rest.data.type = $scope.model;
            rest.data.pageId = $scope.pageId;
            rest.post({"data": rest.data}).then(
                $scope.successCallback,
                $scope.failCallback
            );
        }

        $scope.removeTag = function(tag)
        {
            var rest =  Restangular.one('api/v1/tags');
            rest.data = {};
            rest.data.tag = tag.text;
            rest.data.type = $scope.model;
            rest.data.pageId = $scope.pageId;
            rest.customDELETE().then(
                $scope.successCallback,
                $scope.failCallback
            );
        }

        $scope.successCallback = function(response)
        {
            return response;
        }

        $scope.failCallback = function(response)
        {
            return response;
        }

        $scope.getPageInfo();

        $scope.getCurrentTags = function()
        {
            if($scope.pageId !=false){
                Restangular.one('api/v1/tags', $scope.model).one($scope.pageId).get().then(function(response){
                        $scope.currentTags = response.data;

                    }
                );
            }
        }
        $scope.getCurrentTags();

        $scope.getAllTags = function ()
        {
            if($scope.pageId !=false){
                Restangular.one('api/v1/tags', $scope.model).get().then(function(response){
                        $scope.allTags = response.data;
                    }
                );
            }
        }

        $scope.getAllTags();

    }]);
