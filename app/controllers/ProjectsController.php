<?php

use CMS\Services\ProjectsService;

class ProjectsController extends \BaseController {

  protected $project_dest;
  protected $project_uri;
  protected $save_to;
  /**
   * @var CMS\Services\ProjectsService
   */
  private $projectsService;

  public function __construct(ProjectsService $projectsService = null)
  {
    parent::__construct();
    $this->project_dest = public_path() . "/img/projects";
    $this->project_uri = 'img/projects';
    $this->save_to = public_path() . "/img/projects";
    $this->projectsService = $projectsService;
  }
  /**
   * Display a listing of projects
   *
   * @return Response
   */
  public function index()
  {
    $page = Page::find(4);
    return Redirect::to($page->slug, 301);

  }

  /**
   * Display a listing of portfolios
   *
   * @return Response
   */
  public function adminIndex($project = NULL)
  {
    parent::show();
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
    parent::show();
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

    $all = Input::all();
    $rules = Project::$rules;
    $validator = $this->validateSlugOnCreate($all, $rules);

    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }
    if(isset($all['image'])) {
      $all = $this->uploadFile($all, 'image');
    }
    $project = Project::create($all);

    if(isset($all['images'])) {
      $this->projectsService->addImages($project->id, $all['images'], 'Project');
    }
    return Redirect::route('admin_projects')->withMessage("Created Project");
  }

  public function show($project = NULL)
  {
    parent::show();
    if(is_numeric($project)) {
      $project = Project::find($project);
    }

    if($project == NULL || !is_numeric($project)){
      return View::make('404', compact('settings'));
    }
    if(isset($project->seo)){
    $seo = $project->seo;
    }
      $banner = TRUE;
    return View::make('projects.show', compact('project', 'banner', 'settings', 'seo'));
  }

  /**
   * Show the form for editing the specified project.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id = NULL)
  {
    parent::show();
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
    $project  = Project::findOrFail($id);

    //1. see if the slug is the same as the original
    //2. if it is then we will not validate against right
    $all = Input::all();
    $rules = Project::$rules;
    $validator = $this->validateSlugEdit($all, $project, $rules);
    $data = $this->checkPublished($all);

    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }
    if(isset($data['image'])) {
      $data = $this->uploadFile($data, 'image');
    } else {
      $data['image'] = $project->image;
    }
    if(isset($data['image_caption_update'])){
      $this->updateImagesCaption($data['image_caption_update']);
    }
    if(isset($data['image_order_update'])){
      $this->updateImagesOrder($data['image_order_update']);
    }

    if(isset($data['images'])) {
      $this->projectsService->addImages($project->id, $data['images'], 'Project');
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
