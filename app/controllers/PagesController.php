<?php

class PagesController extends \BaseController {

    public $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = $this->pages->getAll();
        var_dump($page->toArray());
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
            $page = Page::find($id);
        }
		if(Request::format() == 'html') {
            if(!$page) {
               return View::make('404');
            }
            return View::make('pages.show', compact('page'));
        } else {
            if(!$page) {
                return Response::json(null, 404);
            }
            return Response::json($page, 200);
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
		//
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