<?php

use CMS\Services\ImagesService;
use Intervention\Image\Facades\Image;

class PostsController extends \BaseController {

    protected $post_dest;
    protected $post_uri;
    protected $save_to;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function __construct(ImagesService $imagesService)
    {
        parent::__construct();
        $this->imagesService = $imagesService;
        $this->post_dest = public_path() . "/img/posts";
        $this->post_uri = 'img/posts';
        $this->save_to = public_path() . "/img/posts";
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
        $rules = Post::$rules;
        $validator = $this->validateSlugOnCreate($all, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(isset($all['image'])) {
            $all = $this->uploadFile($all, 'image');
            $image = Image::make($input['image']->getRealPath());
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
        $path = $this->post_uri;
        return View::make('posts.edit', compact('post', 'path'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $post  = Post::findOrFail($id);

        //1. see if the slug is the same as the original
        //2. if it is then we will not validate against right
        $all = Input::all();
        $rules = Post::$rules;
        $validator = $this->validateSlugEdit($all, $post, $rules);
        $data = $this->checkPublished($all);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(isset($data['image'])) {
            $image = \Intervention\Image\Facades\Image::make($all['image']->getRealPath());
            $filename = ($all['image']->getClientOriginalName());
            $image->save($this->save_to . $filename)
                  ->resize(1000, null,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();})
                  ->crop(270, 340)
                  ->save($this->save_to . '/thumb/' . $filename);
            $data = $this->uploadFile($data, 'image');
        } else {
            $data['image'] = $post->image;
        }
        if(isset($data['image_caption_update'])){
            $this->updateImagesCaption($data['image_caption_update']);
        }
        if(isset($data['image_order_update'])){
            $this->updateImagesOrder($data['image_order_update']);
        }

        if(isset($data['images'])) {
            $this->imagesService->addImages($post->id, $data['images'], 'Post');
        }
        $data = $this->checkPublished($data);
        $post->update($data);
        return Redirect::route('posts.index')->withMessage("Updated Post!");
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