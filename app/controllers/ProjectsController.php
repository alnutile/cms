<?php

class ProjectsController extends \BaseController {

    protected $project_dest;
    protected $project_uri;
    protected $save_to;

    public function __construct()
    {
        parent::__construct();
        $this->project_dest = public_path() . "/img/projects";
        $this->project_uri = 'img/projects';
        $this->save_to = public_path() . "/img/projects";
    }
	/**
	 * Display a listing of projects
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::to('portfolios', 301);
	}

    /**
     * Display a listing of portfolios
     *
     * @return Response
     */
    public function adminIndex()
    {
        $projects = Project::all();

        return View::make('projects.admin_index', compact('projects'));
    }

	/**
	 * Show the form for creating a new project
	 *
	 * @return Response
	 */
	public function create()
	{
        $portfolios = Portfolio::allPortfoliosSelectOptions();
		return View::make('projects.create', compact('portfolios'));
	}


	/**
	 * Store a newly created project in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Project::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        if(isset($data['image'])) {
            $data = $this->uploadFile($data, 'image');
        }

		Project::create($data);

		return Redirect::route('admin_projects')->withMessage("Created Project");
	}


	/**
	 * Display the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        /* we do now show A project */
        $project = Project::find($id);
		return Redirect::to('portfolios/' . $project->portfolio_id, 301);
	}

	/**
	 * Show the form for editing the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::find($id);
        $portfolios = Portfolio::allPortfoliosSelectOptions();
        $path = $this->project_uri;
		return View::make('projects.edit', compact('project', 'portfolios', 'path'));
	}

	/**
	 * Update the specified project in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$project = Project::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Project::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        if(isset($data['image'])) {
            $data = $this->uploadFile($data, 'image');
        } else {
            $data['image'] = $project->image;
        }
        $data = $this->checkPublished($data);
        $project->update($data);

		return Redirect::route('admin_projects')->withMessage("Updated Project!");
	}

    /**
	 * Remove the specified project from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Project::destroy($id);

		return Redirect::route('projects.index');
	}

}
