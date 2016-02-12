<?php

use CMS\Services\ImagesService;
use CMS\Services\TagsService;
use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class PagesController extends \BaseController {

    public $pages;

    public function __construct(Page $pages = null, TagsService $tagsService = null, ImagesService $imagesService = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['index', 'create', 'delete', 'edit', 'update', 'store']));
        $this->pages = ($pages == null) ? new Page : $pages;
        $this->tags = $tagsService;
        $this->imagesService = $imagesService;
    }
		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
    {
		parent::show();
		$pages = $this->pages->all();
		$banner = $this->banner;
		if($this->settings->theme == true)
		{
			return $this->respond($pages, 'pages.index_dark',  compact('pages', 'banner'));

		} else
		{
			return $this->respond($pages, 'pages.index',  compact('pages', 'banner'));
		}
	}

		public function adminIndex()
	{
		parent::show();
		$pages = $this->pages->all();
		// print_r($pages);
		// dd($pages);
		$banner = $this->banner;
		return View::make('pages.admin_index', compact('pages', 'settings'));
    }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
		{
            print_r("am in create");
             
    	// Added from Andy's code example
        parent::show(); 
            
        // this is a way of creating a view
        // the 'pages.create' parameter references the pages folder (app/views/pages)
        // and the create.blade.php file (create) in the pages folder
 
        return View::make('pages.create');
		}

        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function show($page = NULL)
    {
        parent::show();
        parent::getSlides();
        if(is_numeric($page)) {
            $page = Page::find($page);
        }
        if($page == NULL){
            return View::make('404', compact('settings'));
        }
        $projects = Project::orderBy('id','asc')->paginate(2);
        $seo = $page->seo;
        $banner = TRUE;
        $page->id == 4 ? $tags = $this->getTags() : $tags = null;
        $this->settings->pageId = $page->id;
        $this->settings->menu_name = $page->menu_name;
        $page->id == 1 ? JavaScript::put(['home'=>'home']) : JavaScript::put(['home'=>'notHome']);
        return View::make('pages.show', compact('page', 'banner', 'settings', 'seo', 'projects', 'tags'));
    }

        public function getTags() {
        if($this->tags == null){
            $this->tags =  $this->setTags();
        }
        $tags = $this->tags->get_tags_for_type('Project');
        return  $tags;
    }

        private function setTags()
    {
        return New CMS\Services\TagsService;
    }


        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store() {
        
    	// Added from Andy's code example
        $input = Input::all();
      //  die($input);
        $rules = Page::$rules;
        // print_r($rules);
                   
		$validator = Validator::make($input, array('slug' => 'regex:/^\/[A-Za-z0-9_]+$/')); 
                                                 
					if($validator->passes()) {
                     
                     // print_r(array_values($input));
                     // die("in validator test") ;
                      
						$page = Page::create($input);
						$banner = $this->bannerSet($page);
                     //  return Redirect::to('pages.admin_index'->withMessage("Created Page");
                        return Redirect::to('pages/' . $page->id)->withMessage("Page Created ");
					} else {
                        return Redirect::back()->withErrors($validator)->withInput();
					}
    	}
	
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function edit($id = NULL)
    {
        parent::show();
        $page = Page::findOrFail($id);
        parent::checkForSlideshow($page->id);
        return View::make('pages.edit', compact('page', 'settings', 'slideshow'));
    }


        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function update($id)
    {
        $page_update = Input::all();
//        dd($page_update);
        if($this->settings->theme != true) {
            $validator = Validator::make($page_update, array('title' => 'required', 'slug' => 'regex:/^\/[A-Za-z0-9_]+$/'));
            $page = Page::find($id);
            if($validator->passes()) {
                $page->title = $page_update['title'];
                $page->body = $page_update['body'];
                $page->seo = $page_update['seo'];
                $page->slug = (isset($page_update['slug'])) ?  $page_update['slug'] : $page->slug;
                if(isset($page_update['images'])) {
                    $this->imagesService->addImages($page->id, $page_update['images'], 'Page');
                }
                $page->save();
                $banner = $this->bannerSet($page);
                return Redirect::to("/pages/")->withMessage("Page Updated");
            } else {
                return Redirect::to('pages/' . $page->id . '/edit')->withErrors($validator)
                    ->withMessage("Error ");
            }

        } else{
            $validator = Validator::make($page_update, array('slug' => 'regex:/^\/[A-Za-z0-9_]+$/'));
            $page = Page::find($id);
            if($validator->passes()) {
                $page->seo = $page_update['seo'];
                $page->title = $page_update['title'];
                $page->body = $page_update['body'];
                $page->slug = (isset($page_update['slug'])) ?  $page_update['slug'] : $page->slug;
                $page->save();
                $banner = $this->bannerSet($page);
                return Redirect::to("/pages/")->withMessage("Page Updated");
            } else {
                return Redirect::to('pages/' . $page->id . '/edit')->withErrors($validator)
                    ->withMessage("Error ");
            }
        }



    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
    {
        Page::destroy($id);
        return Redirect::route('pages.index');
    }



    }