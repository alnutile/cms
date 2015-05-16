var uploadControllers = angular.module('uploadControllers', []);

uploadControllers.controller('UploadImagesController', ['$scope', 'Restangular', 'Noty', '$window',
    function($scope, Restangular, Noty, $window){
        $scope.pageId = false;

        $scope.deleteImage = function(id) {
            Restangular.one('api/v1/images', id).remove();
            angular.forEach($scope.images, function(v, i){
                if(v.id == id)
                {
                    $scope.images.splice(i, 1)
                }
            });
            Noty('Image deleted', 'success');
        };


        $scope.getPageInfo = function()
        {
            var path = $window.location.pathname;
            path_array = path.split('/');
            $scope.pageId   = path_array[2];
            var model   = path_array[1];
            $scope.model = model;
        }

        $scope.getPageInfo();

        $scope.getImages = function()
        {
            if($scope.pageId !=false){
                Restangular.one('api/v1/getImageFromImageableItem', $scope.model).one($scope.pageId).get().then(function(response){
                        $scope.images = response.data;
                        angular.forEach($scope.images, function(v,i){
                            v.order = parseFloat(v.order);
                        })
                        console.log($scope.images);
                    }
                );
            }
        }

        if(!isNaN($scope.pageId))
        {
            $scope.getImages();
        }

        $scope.getImagesForSlug = function()
        {
            if($scope.pageId !=false){
                Restangular.one('api/v1/getImageForSlug', $scope.model).get().then(function(response){
                        $scope.images = response.data;
                    }
                );
            }
        }
        if(isNaN($scope.pageId))
        {
        $scope.getImagesForSlug();
        }


    }]);