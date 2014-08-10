<?php namespace CMS\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;

class ImagesServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Images', function()
        {
            return new \CMS\Services\ImagesService(new \Image);
        });

    }

}