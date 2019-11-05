<?php

use CMS\Services\TagsService;

class PortfolioCategoryController extends \BaseController {

	/**
     * Display a listing of Portfolio categories 
     *
     * @return Response
     */
	 
	public function __construct(Portfolio $portfolio = null, TagsService $tagsService = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['adminIndex', 'create', 'delete', 'edit', 'update', 'store']));
        $this->portfolio = ($portfolio == null) ? new Portfolio : $portfolio;
        $this->tags = $tagsService;
    }

	public function adminIndex()
    {
		
		$categories = Portfolio_Category::get();
		return View::make('portfolio_category.admin_index', compact('categories'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		parent::show();
		return View::make('portfolio_category.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Input::all();
        $rules = Portfolio_Category::$rules;
        $validator = $this->validateSlugOnCreatePortfolioCategory($all, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Portfolio_Category::create($all);

        return Redirect::route('portfolio_categories');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($array = NULL)
	{
		$settings = Setting::select('theme','logo','multiple_portfolio')->first();
		$project_category = Request::get('id');
		$projects = Project::where('project_category',$project_category)->get();
		return View::make('portfolio_category.categoriesIndex_dark', compact('projects','settings'));
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
        $categories = Portfolio_Category::find($id);

        return View::make('portfolio_category.edit', compact('categories'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$Portfolio_Category = Portfolio_Category::findOrFail($id);
        $messages = [];
        //1. see if the slug is the same as the original
        //2. if it is then we will not validate against right
        $all = Input::all();
        $rules = Portfolio_Category::$rules;

        $validator = $this->validateSlugEditPortfolioCategory($all, $Portfolio_Category, $rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
		$Portfolio_Category->is_active = (isset($all['isactive'])) ? 1 : 0;
        $Portfolio_Category->update($all);

        return Redirect::route('portfolio_categories');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Portfolio_Category::destroy($id);

        return Redirect::route('portfolio_categories');
	}
	
	private function validateSlugOnCreatePortfolioCategory($all, $rules) {
		$rules = [
			'name' => 'required',
			'slug'  => 'required|unique:pages|unique:portfolios|unique:portfolio_category|unique:posts|unique:projects|regex:/^\/[A-Za-z0-9_]+$/'
		];
        $messages  = array(
            'slug.unique' => 'The url is not unique .',
            'slug.regex'  => 'The url must start with a slash and contain only letters and numbers, no spaces.'
        );
        $validator = Validator::make($data = Input::all(), $rules, $messages);

        return $validator;
    }
	
	private function validateSlugEditPortfolioCategory($all, $model, $rules) {
        $messages = [];
		
		if (isset($all['slug']) && $all['slug'] != $model->slug) {
			$rules = [
				'name' => 'required',
				'slug'  => 'required|unique:pages|unique:portfolios|unique:portfolio_category|unique:posts|unique:projects|regex:/^\/[A-Za-z0-9_]+$/'
			];
            $messages = array(
                'slug.unique' => 'The url is not unique.',
                'slug.regex'  => 'The url must start with a slash and contain only letters and numbers, no spaces.'
            );
        }
        else {
            unset($rules['slug']);
        }
        $validator = Validator::make($data = Input::all(), $rules, $messages);

        return $validator;
    }

}
