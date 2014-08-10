(function() {

'use strict';

angular
    .module('app', [
        'restangular'
    ]).
    config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    });

})();