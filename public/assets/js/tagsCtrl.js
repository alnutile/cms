var tagsCtrl = angular.module('tagsCtrl', []);

tagsCtrl.controller('tagsCtrl', ['$scope', 'Restangular', '$window',
    function($scope, Restangular, $window) {
        $scope.pageId   = false;

        $scope.deleteTag = function(id) {
            Restangular.one('api/v1/tags', id).remove();
            angular.forEach($scope.images, function(v, i){
                if(v.id == id)
                {
                    $scope.images.splice(i, 1)
                }
            });
        };

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
                        $scope.currentTags = response.data;
                    }
                );
            }
        }

        $scope.getAllTags();

    }]);
