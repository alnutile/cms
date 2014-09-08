<?php


class BannersController extends \BaseController {

    protected $banner_model;
    protected $banner_path;
    protected $banner_dest;
    public    $save_to;

    public function __construct(Banner $banner_model = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['index', 'create', 'delete', 'edit', 'update', 'store']));
        $this->banner_model = ($banner_model == null) ? new Banner : $banner_model;
        $this->banner_path = "/img/banners";
        $this->banner_dest = public_path() . "/img/banners";
        $this->save_to = public_path() . "/img/banners";
    }

    public function getBannerPath()
    {
        return $this->banner_path;
    }

	/**
	 * Display a listing of the resource.
	 * GET /banners
	 *
	 * @return Response
	 */
	public function index()
	{
        parent::show();
        $banners = $this->banner_model->all();
        $banner = $this->banner;
        $path = $this->banner_path;
        return $this->respond($banners, 'banners.index',  compact('banners', 'banner', 'path'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /banners/create
	 *
	 * @return Response
	 */
	public function create()
	{
    parent::show();
		return View::make('banners.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /banners
	 *
	 * @return Response
	 */
	public function store()
	{

        $validator = Validator::make($data = Input::all(), Banner::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(isset($data['banner_name'])) {
            $data = $this->uploadFile($data, 'banner_name');
        }

        Banner::create($data);

        return Redirect::to('/banners')->withMessage("Created Banner");
	}

	/**
	 * Display the specified resource.
	 * GET /banners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id = NULL)
	{
    parent::show();
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /banners/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = NULL)
	{
        parent::show();
        $banner = Banner::find($id);
        $path = $this->banner_path;
        return View::make('banners.edit', compact('banner', 'path'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /banners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        $banner = Banner::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Banner::$rules_update);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(isset($data['banner_name'])) {
            $data = $this->uploadFile($data, 'banner_name');
        } else {
            $data['banner_name'] = $banner->banner_name;
        }

        $banner->update($data);

        return Redirect::to("/banners")->withMessage("Banner Updated");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /banners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

}