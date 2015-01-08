<?php

Route::resource('pages', 'PagesController');
Route::resource('users', 'UsersController');
Route::resource('banners', 'BannersController');
Route::resource('settings', 'SettingsController');
Route::resource('portfolios', 'PortfoliosController');
Route::resource('projects', 'ProjectsController');
Route::resource('posts', 'PostsController');

Route::get('menus', 'MenusController@index');
Route::post('menus', 'MenusController@store');
Route::post('menus', 'MenusController@store');
//for tagged items
Route::get('/posts/tags/{tag}', 'PostsController@index_by_tag');
Route::get('/projects/tags/{tag}', 'ProjectsController@index_by_tag');

#done
Route::get('/login', 'UsersController@login');
#done
Route::put('/login', 'UsersController@authenticate');
#done
Route::get('/logout', array('before' => 'auth', 'uses' => 'UsersController@getLogout'));

Route::get('/admin/portfolios', array(
  'before' => 'auth',
  'as' => 'admin_portfolio',
  'uses' => 'PortfoliosController@adminIndex'
));

Route::get('/admin/projects', array(
  'before' => 'auth',
  'as' => 'admin_projects',
  'uses' => 'ProjectsController@adminIndex'
));




Route::get('/admin', array('before' => 'auth', 'uses' => 'AdminController@dash'));


Route::get('/{id?}', function($id = null){
  return Menu::show($id);
});

Route::get('/auth/token', function(){
  return csrf_token();
});


Route::group(array('before' => 'auth'), function() {


  /**
   * Get images for project x
   *
   */
  Route::get('/api/v1/getImageFromImageableItem/{imageable_type}/{imageable_id}', 'ImagesController@getImageFromImageableItem');
  Route::post('/api/v1/getImageFromImageableItem/{imageable_type}/{imageable_id}', function() {
    return Image::create(Input::all());
  });

    //get all the tags that have been used on any content type for the autocomplete list
  Route::get('/api/v1/tags/{model}', 'TagsController@all_tags');
    //get list of tags for autocomplete
  Route::get('/api/v1/tags/{model}/autocomplete/{query}', 'TagsController@autocomplete_tags');
    //get all the tags for the current resource
  Route::get('/api/v1/tags/{model}/{id}', 'TagsController@get_tags');
    //post new tags for a new resource
  Route::post('/api/v1/tags', 'TagsController@store');
    //delete a tags by name on an existing resource
  Route::delete('/api/v1/tags', 'TagsController@delete_tag_by_name');

  Route::resource('/api/v1/images', 'ImagesController');

  Route::get('images/upload/{model}', 'ImagesController@uploadImage');
  Route::post('images/upload/{model}', 'ImagesController@uploadImage');

  Route::post('/api/v1/ckeditor/images', function(){
    $files = new FilesController();
    return $files->postImage();
  });

  Route::post('/api/v1/ckeditor/files', function(){
    $files = new FilesController();
    return $files->postFile();
  });

  Route::get('/api/v1/ckeditor/files', function(){
    $files = new FilesController();
    return  $files->getFiles();
  });

  Route::get('/api/v1/ckeditor/gallery', function(){
    $images = new FilesController();
    return $images->getImageswysiwyg();
  });

});

