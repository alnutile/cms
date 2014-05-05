<?php

use Symfony\Component\Filesystem\Filesystem;

class BannersController extends \BaseController {

    protected $banner_model;
    protected $filesystem;
    protected $banner_path;
    protected $banner_dest;

    public function __construct(Banner $banner_model = null, Filesystem $filesystem = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['index', 'create', 'delete', 'edit', 'update', 'store']));
        $this->banner_model = ($banner_model == null) ? new Banner : $banner_model;
        $this->filesystem = ($filesystem == null) ? new Filesystem : $filesystem;
        $this->banner_path = "/img/banners";
        $this->banner_dest = "public/img/banners";
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

        if(Input::hasFile('banner_name')) {
            $file = Input::file('banner_name');
            $filename = $file->getClientOriginalName();
            $destination = $this->banner_dest;

            if(!$this->filesystem->exists($destination)) {
                $this->filesystem->mkdir($destination);
            }

            try {
                Input::file('banner_name')->move($destination, $filename);
            } catch(Exception $e) {
                dd("Error uploading file " . $e->getMessage());
            }
            $data['banner_name'] = $filename;
        }
        $data['active'] = (isset($data['active'])) ? $data['active'] : 0;

        $project = Banner::create($data);
        return Redirect::to("/banners")->withMessage("Banner Created");
	}

	/**
	 * Display the specified resource.
	 * GET /banners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /banners/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
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
        $validator = Validator::make($data = Input::all(), ['name' => 'required']);
        $banner = Banner::findOrFail($id);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(Input::hasFile('banner_name')) {
            $file = Input::file('banner_name');
            $filename = $file->getClientOriginalName();
            $destination = $this->banner_dest;

            if(!$this->filesystem->exists($destination)) {
                $this->filesystem->mkdir($destination);
            }

            try {
                Input::file('banner_name')->move($destination, $filename);
            } catch(Exception $e) {
                dd("Error uploading file " . $e->getMessage());
            }
            $data['banner_name'] = $filename;
        } else {
            $data['banner_name'] = $banner->banner_name;
        }

        $banner->name           = $data['name'];
        $banner->active         = (isset($data['active'])) ? $data['active'] : 0;
        $banner->order          = $data['order'];
        $banner->banner_name    = $data['banner_name'];
        $banner->save();
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
		//
	}

}