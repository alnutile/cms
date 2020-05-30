<?php 
namespace CMS\Services;
use CMS\Services\TagsService as TagsService;
Class MenuService {

  protected $pageModel;
  public $settings;
  public $project;
  public $portfolio;
  public $post;
  public $secondary_post;
  public $portfolio_category;
	private $navigations_menu = array();
  public function __construct(Page $pageModel = null, Setting $settings = null, Portfolio $portfolio = null, Project $project = null, Post $post = null,Portfolio_Category $portfolio_category = null,SecondaryBlog $secondary_post = null)
  {
    $this->pageModel = ($pageModel == null) ? new \Page : $pageModel;
    $this->settings = ($settings == null) ? new \Setting : $settings;
    $this->project = ($project == null) ? new \Project : $project;
    $this->portfolio = ($portfolio == null) ? new \Portfolio : $portfolio;
    $this->post = ($post == null) ? new \Post : $post;
	$this->secondary_post = ($secondary_post == null) ? new \SecondaryBlog : $secondary_post;
	$this->portfolio_category = ($portfolio_category == null) ? new \Portfolio_Category : $portfolio_category;
      $this->tags = new \CMS\Services\TagsService;
      $this->images = new \CMS\Services\ImagesService(new \Image());
      $this->projects = new \CMS\Services\ProjectsService($this->images);
  }
	public function saveMenus()
	{
		$top = 0;
		foreach($this->navigations_menu as $nav_menus)
		{
			$reset_array = array_values($nav_menus);
			for($i=0; $i<count($reset_array);$i++)
			{
				if(array_key_exists('children',$reset_array[$i]))
				{
					unset($reset_array[$i]['children']);
				} 
			}
			$count = 1;
			foreach($reset_array as $updated_navs)
			{
				if(isset($updated_navs['pageId']))
				{
					$page_id         = $updated_navs['pageId'];
					$page = $this->pageModel->findOrFail($page_id);
					if($top == 0)
					{
						$page->menu_parent      = 0;
						$page->menu_name        = 'top';
					}
					else
					{
						$page->menu_parent      = $updated_navs['pageMenuParent'];
						$page->menu_name        = $updated_navs['menuLocation'];
					}
					$page->menu_sort_order  = $count;
					$page->save();
					$count++;
				}
			}
			$top++;
		}
	}
	public function updateMenus($updates, $resursive=false)
	{
		$this->navigations_menu [] = $updates;
		if(count($updates)) 
		{
			$count = 1;
			foreach($updates as $menu) 
			{
				if(isset($menu['pageId']))
				{
					$parent_id         = $menu['pageId'];
					if(isset($menu['children']))
					{
						$sub_menus = $menu['children'][0];
						for($i = 0; $i<count($sub_menus); $i++)
						{
							$sub_menus[$i]['pageMenuParent'] = $parent_id;
							$sub_menus[$i]['menuLocation'] = 'sub_nav';
						}
						$this->updateMenus($sub_menus, $resursive = true);
						
					}
				}
				
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
	
	/*
	* Try portfolio categroy
	*/
	$portfolio_category = $this->portfolio_category->where("slug", 'LIKE', '/' . $id)->first();
	if(isset($portfolio_category) && $portfolio_category->is_active == 1){
		$portfolioCategoryCtrl = new \PortfolioCategoryController();
		return $portfolioCategoryCtrl->show($portfolio_category);
	}
	/*
	* Try secondary POst
	*/
	$secondary_post = $this->secondary_post->where("slug", 'LIKE', '/' . $id)->first();
	if($secondary_post){
		$postCtrl = new \BlogController($this->images, $this->tags);
		return $postCtrl->show($secondary_post->id);
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