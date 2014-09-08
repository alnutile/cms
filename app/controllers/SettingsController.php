<?php

use Symfony\Component\Filesystem\Filesystem;

class SettingsController extends \BaseController {

    protected $filesystem;
    protected $settings_path;

    public function __construct(Filesystem $filesystem = null)
    {
        parent::__construct();
        $this->filesystem = ($filesystem == null) ? new Filesystem() : $filesystem;
        $this->beforeFilter("auth", array('only' => ['index', 'create', 'delete', 'edit', 'update', 'store']));
        $this->settings_path = public_path() . "/img/settings";
    }
	/**
	 * Display a listing of the resource.
	 * GET /settings
	 *
	 * @return Response
	 */
	public function index()
	{
    parent::show();
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /settings/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /settings
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /settings/{id}
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
	 * GET /settings/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = NULL)
	{
        parent::show();
        $banner = $this->banner;
        $path   = "/img/settings";
        $setting = Setting::find($id);
		return View::make('settings.edit', compact('setting', 'path', 'banner'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /settings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make($data = Input::all(), ['color' => 'required']);
        $setting = Setting::findOrFail($id);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(Input::get('remove_logo') != NULL) {
            $data['logo'] = '';
        } elseif(Input::hasFile('logo')) {
            $file = Input::file('logo');
            $filename = $file->getClientOriginalName();
            $destination = $this->settings_path;

            if(!$this->filesystem->exists($destination)) {
                $this->filesystem->mkdir($destination);
            }
            try {
                Input::file('logo')->move($destination, $filename);
            } catch(Exception $e) {
                dd("Error uploading file " . $e->getMessage());
            }
            $data['logo'] = $filename;
        } else {
            $data['logo'] = $setting->logo;
        }

        $setting->color             = $data['color'];
        $setting->logo              = $data['logo'];
        $setting->name              = $data['name'];
        $setting->maintenance_mode  = (isset($data['maintenance_mode'])) ? 1 : 0;
        $this->setRobot($setting->maintenance_mode);
        $setting->facebook          = (isset($data['facebook'])) ? $data['facebook'] : '';
        $setting->linkedin          = (isset($data['linkedin'])) ? $data['linkedin'] : '';
        $setting->twitter           = (isset($data['twitter'])) ? $data['twitter'] : '';
        $setting->pinterest         = (isset($data['pinterest'])) ? $data['pinterest'] : '';
        $setting->gplus             = (isset($data['gplus'])) ? $data['gplus'] : '';
        $setting->footer            = (isset($data['footer'])) ? $data['footer'] : '';
        $setting->save();
        return Redirect::to("/settings/" . $setting->id . "/edit")->withMessage("Settings Updated");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /settings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    protected function setRobot($mode)
    {
        $path = public_path();
        if($mode === 'on' || $mode == '1') {
            $this->filesystem->copy($path . '/robots.txt.block', $path . '/robots.txt', $override = true);
        }
        if($mode === 0) {
            $this->filesystem->copy($path . '/robots.txt.allow', $path . '/robots.txt', $override = true);
        }
    }

}