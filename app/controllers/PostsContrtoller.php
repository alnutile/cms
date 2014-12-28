<?php

use CMS\Services\ImagesService;

class PostsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function __construct(ImagesService $imagesService)
    {
        parent::__construct();
        $this->imagesService = $imagesService;
    }

	public function index()
	{
        parent::show();
		$posts = Post::all();

        return View::make('posts.index', compact('posts'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        parent::show();
        return View::make('posts.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $all = Input::all();
        $rules = Project::$rules;
        $validator = $this->validateSlugOnCreate($all, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(isset($all['image'])) {
            $all = $this->uploadFile($all, 'image');
        }
        $post = Post::create($all);

        if(isset($all['images'])) {
            $this->imagesService->addImages($post->id, $all['images'], 'Post');
        }
        return Redirect::route('posts')->withMessage("Created Post");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id = NULL)
	{
        parent::show();
        if(is_numeric($id)) {
            $post = Post::find($id);
        }
        if($id == NULL){
            return View::make('404', compact('settings'));
        }
        $seo = $post->seo;
        $banner = TRUE;
        return View::make('posts.show', compact('post', 'banner', 'settings', 'seo'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        parent::show();
        $post = Post::find($id);

        return View::make('posts.edit', compact('post'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
