'use strict';

var app = angular.module('app', [
        'restangular',
        'alertServices',
        'flow',
        'projectControllers'
    ]).
    config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]'); //{{ }}
    });

