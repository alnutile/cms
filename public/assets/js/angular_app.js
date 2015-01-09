'use strict';

var app = angular.module('app', [
        'restangular',
        'alertServices',
        'flow',
        'uploadControllers',
        'ngTagsInput',
        'tagsCtrl',
        'angular-flexslider'
    ]).
    config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]'); //{{ }}
    });

