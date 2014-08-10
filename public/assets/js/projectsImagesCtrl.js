(function() {

    'use strict';

    function ProjectsServices()
    {
        this.get_files = function()
        {
            return [1,2,3];
        }
    }

    angular.module('app').factory('ProjectsServices', ProjectsServices);


    function ProjectImagesCtrl(ProjectsServices)
    {
        this.test = "You are here";

        this.project_services = ProjectsServices;

        this.example_service = ProjectsServices.get_files();

    }

    angular
        .module('app')
        .controller('ProjectImagesCtrl', ProjectImagesCtrl);

})();