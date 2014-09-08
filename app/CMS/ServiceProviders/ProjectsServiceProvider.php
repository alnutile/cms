<?php
/**
 * Created by PhpStorm.
 * User: andrewcavanagh
 * Date: 8/31/14
 * Time: 10:39 AM
 */

namespace CMS\ServiceProviders;


use CMS\Services\ImagesService;
use CMS\Services\ProjectsService;
use Illuminate\Support\ServiceProvider;

class ProjectsServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('ProjectsService', function()
    {
      return new ProjectsService(
        new ImagesService(
          new \Image()
        )
      );
    });
  }
} 