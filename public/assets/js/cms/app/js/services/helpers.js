angular.module('cms.helpers', [])
    .factory('slug', ['$rootScope',
        function($rootScope){
            return function(slug) {
                var fixed = slug.replace(/[^\w\s]/gi, '');
                var spaces = fixed.replace(/ /gi, '_');
                var lower_case = spaces.toLowerCase();
                return '/' + lower_case;
            }
        }]);