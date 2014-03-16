'use strict';

angular.module('cms.usersServices', ['ngResource'])
    .factory('UsersServices', ['$resource',
    function($resource){
        return $resource('/api/v1/site/admin/users/:uid', {}, {
            query: {method:'GET', params:{uid:''}, isArray:true},
            update: {method: 'PUT', isArray:false},
            create: {method:'POST', isArray:false}
        });
    }]);