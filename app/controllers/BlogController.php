<?php
use CMS\Services\ImagesService;
use CMS\Services\TagsService;
use Intervention\Image\Facades\Image;
class BlogController extends \BaseController {
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
        $this->post_dest = public_path() . "/img/secondary-posts";
        $this->post_uri = 'img/secondary-posts';
        $this->save_to = public_path() . "/img/secondary-posts";
        $this->tags = $tagsService;
        $this->beforeFilter("auth", array('only' => ['create', 'delete', 'edit', 'update', 'store']));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		parent::show();
        $posts = SecondaryBlog::where('published', '=', 1)->orderBy('created_at','desc')->get();
        $tags = $this->tags->get_tags_for_type('SecondaryBlog');
		
        $seo = $this->settings->secondary_blog_title;
        if($this->settings->theme == true) {
			return View::make('secondary-posts.index_dark', compact('posts', 'tags', 'settings', 'seo'));
		} else {
			return View::make('secondary-posts.index', compact('posts', 'tags', 'settings', 'seo'));
		}
	}
	public function adminIndex()
	{
		parent::show();
		$posts = SecondaryBlog::orderBy('created_at','desc')->get();
		return View::make('secondary-posts.admin_index', compact('posts', 'settings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		parent::show();
        return View::make('secondary-posts.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Input::all();
        $rules = SecondaryBlog::$rules;
        $validator = $this->validateSlugOnCreate($all, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(isset($all['image'])) {
            $this->imagesService->resizeAndSaveForPost($all['image'], $this->save_to);
            $all = $this->uploadFile($all, 'image');
        }
        $post = SecondaryBlog::create($all);

		if(isset($all['tags'])) {
			$tags = explode(',', $all['tags']);
			$this->tags->attachNewTags($post->id, $tags, 'SecondaryBlog');
		}

        if(isset($all['images'])) {
            $this->imagesService->addImages($post->id, $all['images'], 'SecondaryBlog');
        }
        return Redirect::route('blog.index')->withMessage("Created Post");
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
            $post = SecondaryBlog::find($id);		
			$seo = $post->seo;
			$post_simple_user = SecondaryBlog::where('id',$id)->where('published',1)->get();
        }
        if($id == NULL){
            return View::make('404', compact('settings'));
        }
        $tags = $this->tags->get_tags_for_type('SecondaryBlog');
        $banner = TRUE;	
		if( Auth::user() && Auth::user()->admin == 1 )
		{			
			return View::make('secondary-posts.show', compact('post', 'banner', 'settings', 'seo', 'tags'));
		}else{			
			if(count($post_simple_user) > 0){				
				return View::make('secondary-posts.show', compact('post', 'banner', 'settings', 'seo', 'tags'));
			}else{				
				// $a=$this->index();
				// return $a;
				return abort(404);
			}			
		}
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
        $post = SecondaryBlog::find($id);
        $path = $this->post_uri;
        return View::make('secondary-posts.edit', compact('post', 'path'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post  = SecondaryBlog::findOrFail($id);

        //1. see if the slug is the same as the original
        //2. if it is then we will not validate against right
        $all = Input::all();
        $rules = SecondaryBlog::$rules;
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
        return Redirect::route('blog.index')->withMessage("Updated Post!");
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
        SecondaryBlog::destroy($id);

        return Redirect::route('blog.index');
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
            ->where('tags.tagable_type', '=', 'SecondaryBlog')
			->where('published', '=', 1)
            ->where('tags.name', '=', $tag)
			->orderBy('posts.created_at', 'desc')
            ->groupBy('posts.id')
            ->get();
        $tags = $this->tags->get_tags_for_type('SecondaryBlog');
        $seo = $tag;
        if($this->settings->theme == true) {
			return View::make('secondary-posts.indexByTag_dark', compact('posts', 'settings', 'tags', 'seo' ));
		} else {
			return View::make('secondary-posts.indexByTag', compact('posts', 'settings', 'tags', 'seo' ));
		}  
    }

}
