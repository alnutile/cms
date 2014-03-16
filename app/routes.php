<?php

Route::get('/', function()
{
    return View::make('layouts.angular');
});

#done
Route::get('/login', 'UsersController@login');
#done
Route::put('/login', 'UsersController@authenticate');
#done
Route::get('/logout', array('before' => 'auth', 'uses' => 'UsersController@getLogout'));
#done
Route::get('/users/edit', array('before' => 'auth', 'uses' => 'UsersController@edit'));
#done
Route::put('/users/update', array('before' => 'auth', 'uses' => 'UsersController@updatePassword'));

//Route::get('api/v1/site/page/:pid',         'PageController@show'); //home, about, contact
//Route::get('api/v1/site/blog',              'BlogController@index');
//Route::get('api/v1/site/blog/{:bid}',       'BlogController@show');
//Route::get('api/v1/site/portfolio/{:pid}',  'PortfolioController@show');

Route::group(array('before' => 'admin'), function()
{
    Route::resource('api/v1/site/admin/users',           'UsersController');
    Route::get('api/v1/site/admin/pages',           'PagesController@index');
    Route::get('api/v1/site/admin',                 'AdminController@index');
});

App::missing(function($exception)
{
    return View::make('layouts.angular');
});