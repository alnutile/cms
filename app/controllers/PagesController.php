<?php

class PagesController extends \BaseController {

    public $pages;

    public function __construct(Page $pages = null)
    {
        $this->pages = ($pages == null) ? new Page : $pages;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::guest()) {
            return Response::json(null, 403);
        } else {
            $pages = $this->pages->all();
            return Response::json($pages, 200);
        }
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

		if(Request::format() == 'html') {
            if(!$page) {
               return View::make('404');
            }
            return View::make('pages.show', compact('page'));
        } else {
            if(!$page) {
                return Response::json(null, 404);
            }
            return Response::json(array('data' => $page->toArray(), 'status'=>'success', 'message' => "Page found"), 200);
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
        $validator = Validator::make(Input::all(), array('title' => 'required'));
        $page_update = Input::all();
        if($validator->passes()) {
            $page = Page::find($page_update['id']);
            $page->title = $page_update['title'];
            $page->body = $page_update['body'];
            $page->slug = $page_update['slug'];
            $page->save();
            return $this->json_response('success', "Page Updated", $page->toArray(), 200);
        } else {
            $errors = $validator->errors()->toArray();
            return $this->json_response('error', "Page Could not be saved", $errors, 422);
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