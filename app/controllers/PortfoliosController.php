<?php

use CMS\Services\TagsService;

class PortfoliosController extends \BaseController {

    public $portfolio;
    private $tags;

    public function __construct(Portfolio $portfolio = null, TagsService $tagsService = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['adminIndex', 'create', 'delete', 'edit', 'update', 'store']));
        $this->portfolio = ($portfolio == null) ? new Portfolio : $portfolio;
        $this->tags = $tagsService;
    }


    /**
     * Display a listing of portfolios
     *
     * @return Response
     */
    public function index()
    {
        parent::show();
        $portfolios = Portfolio::Published()->OrderByOrder()->get();

        return View::make('portfolios.index', compact('portfolios'));
    }

    /**
     * Display a listing of projects optionally grouped by tag
     *
     * @return Response
     */
    public function projectsIndex()
    {
        parent::show();
        $projects = Project::where('published', '=', 1)->orderBy('order')->get();
        $tags = $this->tags->get_tags_for_type('Project');
        if($this->settings->theme == true) {
			return View::make('portfolios.projectsIndex_dark', compact('projects', 'tags'));
		} else {
			return View::make('portfolios.projectsIndex', compact('projects', 'tags'));
		}
    }

    /**
     * Display a listing of portfolios
     *
     * @return Response
     */
    public function adminIndex($portfolio = NULL)
    {
        parent::show();
        $portfolios = Portfolio::OrderByOrder()->get();

        return View::make('portfolios.admin_index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio
     *
     * @return Response
     */
    public function create()
    {
        parent::show();
        return View::make('portfolios.create');
    }

    /**
     * Store a newly created portfolio in storage.
     *
     * @return Response
     */
    public function store()
    {
        $all = Input::all();
        $rules = Portfolio::$rules;
        $validator = $this->validateSlugOnCreate($all, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Portfolio::create($all);

        return Redirect::route('admin_portfolio');
    }

    /**
     * Display the specified portfolio.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($portfolio = null)
    {
        parent::show();
        if(is_numeric($portfolio)) {
            $portfolio = Portfolio::find($portfolio);
        }

        if($portfolio == NULL){
            return View::make('404', compact('settings'));
        }


        $seo = $portfolio->seo;
        $banner = TRUE;
        return View::make('portfolios.show', compact('portfolio', 'banner', 'settings', 'seo'));
    }

    /**
     * Show the form for editing the specified portfolio.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id = NULL)
    {
        parent::show();
        $portfolio = Portfolio::find($id);

        return View::make('portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $messages = [];
        //1. see if the slug is the same as the original
        //2. if it is then we will not validate against right
        $all = Input::all();
        $rules = Portfolio::$rules;

        $validator = $this->validateSlugEdit($all, $portfolio, $rules);
        $data = $this->checkPublished($all);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $portfolio->update($data);

        return Redirect::route('admin_portfolio');
    }

    /**
     * Remove the specified portfolio from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Portfolio::destroy($id);

        return Redirect::route('portfolios.index');
    }
	
}
