<?php

use CMS\Services\ImagesService;
use CMS\Services\TagsService;
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

    public function __construct(ImagesService $imagesService = null, TagsService $tagsService = null)
    {
        parent::__construct();
        $this->imagesService = $imagesService;
        $this->post_dest = public_path() . "/img/posts";
        $this->post_uri = 'img/posts';
        $this->save_to = public_path() . "/img/posts";
        $this->tags = $tagsService;
        $this->beforeFilter("auth", array('only' => ['create', 'delete', 'edit', 'update', 'store']));
    }

    public function index()
    {
        parent::show();
        $posts = Post::where('published', '=', 1)->orderBy('created_at','desc')->get();
        $tags = $this->tags->get_tags_for_type('Post');
		
        $seo = $this->settings->blog_title;
        if($this->settings->theme == true) {
			return View::make('posts.index_dark', compact('posts', 'tags', 'settings', 'seo'));
		} else {
			return View::make('posts.index', compact('posts', 'tags', 'settings', 'seo'));
		}
    }

  public function adminIndex()
  {
    parent::show();
	$posts = Post::orderBy('created_at','desc')->get();
    return View::make('posts.admin_index', compact('posts', 'settings'));
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
            $this->imagesService->resizeAndSaveForPost($all['image'], $this->save_to);
            $all = $this->uploadFile($all, 'image');;
        }
        $post = Post::create($all);

      if(isset($all['tags'])) {
        $tags = explode(',', $all['tags']);
        $this->tags->attachNewTags($post->id, $tags, 'Post');
      }

        if(isset($all['images'])) {
            $this->imagesService->addImages($post->id, $all['images'], 'Post');
        }
        return Redirect::route('posts.index')->withMessage("Created Post");
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
            $seo = $post->seo;
        }
        if($id == NULL){
            return View::make('404', compact('settings'));
        }
        $tags = $this->tags->get_tags_for_type('Post');
        $banner = TRUE;
        return View::make('posts.show', compact('post', 'banner', 'settings', 'seo', 'tags'));
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
            $this->imagesService->resizeAndSaveForPost($all['image'], $this->save_to);
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
        $tagId = Tag::where('tags.tagable_id', '=', $id)->get();
        foreach($tagId as $tag){
            Tag::destroy($tag->id);
        }
        Post::destroy($id);

        return Redirect::route('posts.index');
    }

    /**
     * Display a listing of the resource by tag.
     *
     * @return Response
     */
    public function index_by_tag($tag)
    {
        parent::show();

        $posts = DB::table('posts')
            ->leftJoin('tags', 'tags.tagable_id', '=', 'posts.id')
            ->where('tags.tagable_type', '=', 'Post')
            ->where('tags.name', '=', $tag)
			->orderBy('posts.created_at', 'desc')
            ->groupBy('posts.id')
            ->get();
        $tags = $this->tags->get_tags_for_type('Post');
        $seo = $tag;
        if($this->settings->theme == true) {
			return View::make('posts.indexByTag_dark', compact('posts', 'settings', 'tags', 'seo' ));
		} else {
			return View::make('posts.indexByTag', compact('posts', 'settings', 'tags', 'seo' ));
		}  
    }
}
