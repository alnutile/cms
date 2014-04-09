'use strict';

/* Filters */

angular.module('cms.filters', []).
    filter('published', function(){
        return function(status) {
            if(status = 1) {
                return 'yes';
            } else {
                return 'no';
            }
        }
    });
