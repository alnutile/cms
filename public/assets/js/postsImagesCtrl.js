var postsControllers = angular.module('postsControllers', []);

postsControllers.controller('PostImagesController', ['$scope', 'Restangular', 'Noty', '$window',
    function($scope, Restangular, Noty, $window){
        $scope.post_id = false;

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


        $scope.getPostId = function()
        {
            var path = $window.location.pathname;
            path_array = path.split('/');
            if(path_array.indexOf('edit') !== -1) {
                $scope.post_id = path_array[2];
            }
        }

        $scope.getPostId();

        $scope.getImages = function()
        {
            if($scope.post_id !=false){
                Restangular.one('api/v1/getImageFromImageableItem/Post', $scope.post_id).get().then(function(response){
                        $scope.images = response.data;
                    }
                );
            }
        }
        $scope.getImages();



    }]);