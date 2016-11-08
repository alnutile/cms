<?php namespace CMS\Services;
use CMS\Services\TagsService as TagsService;
Class MenuService {

  protected $pageModel;
  public $settings;
  public $project;
  public $portfolio;
  public $post;

  public function __construct(Page $pageModel = null, Setting $settings = null, Portfolio $portfolio = null, Project $project = null, Post $post = null)
  {
    $this->pageModel = ($pageModel == null) ? new \Page : $pageModel;
    $this->settings = ($settings == null) ? new \Setting : $settings;
    $this->project = ($project == null) ? new \Project : $project;
    $this->portfolio = ($portfolio == null) ? new \Portfolio : $portfolio;
    $this->post = ($post == null) ? new \Post : $post;
      $this->tags = new \CMS\Services\TagsService;
      $this->images = new \CMS\Services\ImagesService(new \Image());
      $this->projects = new \CMS\Services\ProjectsService($this->images);
  }

  public function updateMenus($updates)
  {
    if(count($updates)) {
      $count = 1;
      foreach($updates as $menu) {
        $id         = $menu['pageId'];
        $parent     = $menu['pageMenuParent'];
        $menu_name  = $menu['menuLocation'];
        if(array_key_exists('children',$menu))
		{
			foreach($menu['children'] as $key => $sub_menu)
			{
				foreach($sub_menu as $item)
				{
					$sub_page_id = $item['pageId'];
					$page = $this->pageModel->findOrFail($sub_page_id);
					$page->menu_parent      = $id;
					$page->menu_name        = 'sub_nav';
					$page->menu_sort_order  = $count;
					$page->save();
				}
				
			}
		}
		else
		{
			$page = $this->pageModel->findOrFail($id);
			$page->menu_parent      = 0;
			$page->menu_name        = 'top';
			$page->menu_sort_order  = $count;
			$page->save();
		}
        $count++;
      }
    }
  }

  /**
   * Display the specified resource.
   * @TODO pull out menu into its own model with a many to many relationship to
   *   Projects, Pages and Portfolios
   * @param  int  $id
   * @return Response
   */
  public function show($id = null)
  {
    $banner = FALSE;
    $type = "pages.show";
    $settings = $this->settings->first();

    if($id == null) {
      $page = $this->pageModel->first();
      $pageCtrl = new \PagesController();
      return $pageCtrl->show($page);
    }

    //Try Page
    $page = $this->pageModel->where("slug", 'LIKE', '/' . $id)->first();
    if ($this->checkIfPublishedAndUserState($page)) {
      ($page->slug === '/home') ? $banner = TRUE : $banner = FALSE;
      $pageCtrl = new \PagesController();
      return $pageCtrl->show($page);
    }
    //Try Project
    $project = $this->project->where("slug", 'LIKE', '/' . $id)->first();
    if ($this->checkIfPublishedAndUserState($project)) {

      $projCtrl = new \ProjectsController($this->projects, $this->tags, $this->images);
      return $projCtrl->show($project);
    }

    //Try Portfolio
    $portfolio = $this->portfolio->where("slug", 'LIKE', '/' . $id)->first();
    if ($this->checkIfPublishedAndUserState($portfolio)) {
      $portfolioCtrl = new \PortfoliosController();
      return $portfolioCtrl->show($portfolio);
    }

      //Try Post
      $post = $this->post->where("slug", 'LIKE', '/' . $id)->first();
      $postCtrl = new \PostsController($this->images, $this->tags);
      return $postCtrl->show($post->id);


    //Else 404
    return \View::make('404', compact('settings'));
  }

  protected function checkIfPublishedAndUserState($model)
  {

    if(isset($model) && $model->published ==1) {
      return true;
    } elseif(isset($model) && !\Auth::guest()) {
      return true;
    } else {
      return false;
    }
  }
}