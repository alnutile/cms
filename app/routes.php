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

Route::get('/api/v1/images', function(){
    $images = [];
    return Response::json($images);
});

Route::post('/api/v1/images', function(){

    $dir = public_path() . '/assets/img/wysiwyg';
    $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
    if ($_FILES['file']['type'] == 'image/png'
        || $_FILES['file']['type'] == 'image/jpg'
        || $_FILES['file']['type'] == 'image/gif'
        || $_FILES['file']['type'] == 'image/jpeg')
    {
        // setting file's mysterious name
        $file = $dir.md5(date('YmdHis')).'.jpg';

        // copying
        $tmp = $_FILES['file']['tmp_name'];
        //$tmp = $dir . '/test.jpg';
        $dest = $dir . '/' . $_FILES['file']['name'];
        $file = new Symfony\Component\Filesystem\Filesystem();
        $file->copy($tmp, $dest);

        // displaying file
        $array = array(
            'filelink' => '/assets/img/wysiwyg/'.$_FILES['file']['name']
        );
        //echo stripslashes(json_encode($array));
    }
    return Response::json($array);
});


Route::get('/api/v1/gallery', function(){
    $array = [array(
        'thumb' => '/assets/img/wysiwyg/test.jpg',
        'image' => '/assets/img/wysiwyg/test.jpg',
        'title' => 'test',
        'folder' => 'Folder 1',
    )];
    return Response::json($array);
});
//Route::get('api/v1/site/blog',              'BlogController@index');
//Route::get('api/v1/site/blog/{bid}',       'BlogController@show');
//Route::get('api/v1/site/portfolio/{pid}',  'PortfolioController@show');

Route::group(array('before' => 'auth'), function() {
    Route::get('api/v1/site/admin/pages', 'PagesController@index');
    Route::get('api/v1/site/admin/pages/{pid?}', function($pid = null){
        $page = new PagesController();
        return $page->show($pid);
    });
    Route::put('api/v1/site/admin/pages/{pid}', 'PagesController@update');
});

Route::group(array('before' => 'admin'), function()
{
    Route::resource('api/v1/site/admin/users',           'UsersController');
    Route::get('api/v1/site/admin',                 'AdminController@index');
});

Route::get('api/v1/current_user', function(){
    return Response::json(Auth::user(), 200);
});

App::missing(function($exception)
{
    return View::make('layouts.angular');
});