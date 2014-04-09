'use strict';

angular.module('cms.pagesService', ['ngResource'])
    .factory('PagesServices', ['$resource',
    function($resource){
        return $resource('/api/v1/site/admin/pages/:pid', {}, {
            query: {method:'GET', params:{pid:''}, isArray:true},
            update: {method: 'PUT', isArray:false},
            create: {method:'POST', isArray:false}
        });
    }]);