<?php

class PagesController extends \BaseController {

    public $pages;

    public function __construct(Page $pages = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['index', 'create', 'delete', 'edit', 'update', 'store']));
        $this->pages = ($pages == null) ? new Page : $pages;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pages = $this->pages->all();
        $banner = $this->banner;
        return $this->respond($pages, 'pages.index',  compact('pages', 'banner'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id = null)
	{
        if($id == null) {
            $page = Page::first();
        } else {
            if(is_numeric($id)) {
                $page = Page::find($id);
            } else {
                $page = Page::where("slug", 'LIKE', '/' . $id)->first();
            }
        }
        if (isset($page) && $page->slug === '/home') {
            $banner = TRUE;
        } else {
            $banner = FALSE;
        }
        $settings = $this->settings;
        return $this->respond($page, 'pages.show',  compact('page', 'banner'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $page = Page::findOrFail($id);
        return View::make('pages.edit', compact('page'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array('title' => 'required', 'slug' =>'regex:/^\//'));
        $page_update = Input::all();
        $page = Page::find($id);

        if($validator->passes()) {
            $page->title = $page_update['title'];
            $page->body = $page_update['body'];
            $page->slug = (isset($page_update['slug'])) ?  $page_update['slug'] : $page->slug;
            $page->save();
            $banner = $this->bannerSet($page);
            Session::put('message', 'Success updating page');
            return $this->respond($page->with('success', "Page Updated"), 'pages.edit',  compact('page', 'banner', 'message'));
        } else {
            return Redirect::to('pages/' . $page->id . '/edit')->withErrors($validator)
                ->withMessage("Error ");
            Session::put('message', 'Error');
            return $this->respond(null, 'pages.edit',  compact('page', 'banner'));
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
		//
	}



}