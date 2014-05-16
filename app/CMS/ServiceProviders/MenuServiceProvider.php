<?php namespace CMS\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Menu', function()
        {
            return new MenuService;
        });
    }

}