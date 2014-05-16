<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 5/16/14
 * Time: 1:28 PM
 */

namespace CMS\Facades;

use Illuminate\Support\Facades\Facade;

class MenuFacade extends Facade {

    protected static function getFacadeAccessor() { return 'Menu'; }

} 