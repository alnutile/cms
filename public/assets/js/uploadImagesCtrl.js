var uploadControllers = angular.module('uploadControllers', []);

uploadControllers.controller('UploadImagesController', ['$scope', 'Restangular', 'Noty', '$window',
    function($scope, Restangular, Noty, $window){
        $scope.project_id = false;

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


        $scope.getProjectId = function()
        {
            var path = $window.location.pathname;
            path_array = path.split('/');
            if(path_array.indexOf('edit') !== -1) {
                $scope.project_id = path_array[2];
            }
        }

        $scope.getProjectId();

        $scope.getImages = function()
        {
            if($scope.project_id !=false){
                Restangular.one('api/v1/getImageFromImageableItem/Project', $scope.project_id).get().then(function(response){
                        $scope.images = reponse.data;
                    }
                );
            }
        }
        $scope.getImages();



    }]);