<?php

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

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
        parent::show();
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
        return View::make('pages.show', compact('page', 'banner', 'settings', 'seo', 'projects'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id = NULL)
    {
        parent::show();
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
        $validator = Validator::make(Input::all(), array('title' => 'required', 'slug' =>'regex:/^\/[A-Za-z0-9_]+$/'));
        $page_update = Input::all();
        $page = Page::find($id);

        if($validator->passes()) {
            $page->title = $page_update['title'];
            $page->body = $page_update['body'];
            $page->seo = $page_update['seo'];
            $page->slug = (isset($page_update['slug'])) ?  $page_update['slug'] : $page->slug;
            $page->save();
            $banner = $this->bannerSet($page);
            return Redirect::to("/pages/")->withMessage("Page Updated");
        } else {
            return Redirect::to('pages/' . $page->id . '/edit')->withErrors($validator)
                ->withMessage("Error ");
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