<?php

class PortfoliosController extends \BaseController {

  public $portfolio;

  public function __construct(Portfolio $portfolio = null)
  {
    parent::__construct();
    $this->beforeFilter("auth", array('only' => ['adminIndex', 'create', 'delete', 'edit', 'update', 'store']));
    $this->portfolio = ($portfolio == null) ? new Portfolio : $portfolio;
  }


  /**
   * Display a listing of portfolios
   *
   * @return Response
   */
  public function index()
  {
    $portfolios = Portfolio::Published()->OrderByOrder()->get();

    return View::make('portfolios.index', compact('portfolios'));
  }

  /**
   * Display a listing of portfolios
   *
   * @return Response
   */
  public function adminIndex()
  {
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
    $this->validateSlugOnCreate($all, $rules);

    Portfolio::create($all);

    return Redirect::route('admin_portfolio');
  }

  /**
   * Display the specified portfolio.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($portfolio)
  {
    if(is_numeric($portfolio)) {
      $portfolio = Portfolio::find($portfolio);
    }

    $seo = $portfolio->seo;
    $banner = FALSE;
    return View::make('portfolios.show', compact('portfolio', 'banner', 'settings', 'seo'));
  }

  /**
   * Show the form for editing the specified portfolio.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
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
