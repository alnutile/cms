'use strict';

var app = angular.module('app', [
        'restangular',
        'alertServices',
        'flow',
        'projectControllers',
        'postsControllers'
    ]).
    config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]'); //{{ }}
    });

