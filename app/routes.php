<?php

Route::get('/admin', function(){
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


Route::group(array('before' => 'auth'), function() {
    Route::get('/testpage', function(){
        $admin = Auth::user()->get(['email']);
        return "You are logged in and your admin status us $admin";
    });
});

Route::get('/{id?}', function($id = null){
    $page = new PagesController();
    return $page->show($id);
});


Route::get('/auth/token', function(){
    return csrf_token();
});



//Route::get('api/v1/site/admin/pages/:pid', function($pid) {
//    $page = new PagesController();
//    return $page->show($pid);
//});


//Route::get('api/v1/site/blog',              'BlogController@index');
//Route::get('api/v1/site/blog/{bid}',       'BlogController@show');
//Route::get('api/v1/site/portfolio/{pid}',  'PortfolioController@show');

Route::group(array('before' => 'admin'), function()
{
    Route::resource('api/v1/site/admin/users',           'UsersController');
    Route::get('api/v1/site/admin/pages', 'PagesController@index');
    Route::get('api/v1/site/admin/pages/{pid?}', function($pid = null){
        $page = new PagesController();
        return $page->show($pid);
    });
    Route::put('api/v1/site/admin/pages/{pid}', 'PagesController@update');

    Route::get('api/v1/site/admin',                 'AdminController@index');
});

Route::get('api/v1/current_user', function(){
    return Response::json(Auth::user(), 200);
});

App::missing(function($exception)
{
    return View::make('layouts.angular');
});