<?php

use CMS\Services\MenuService;

class MenusController extends \BaseController {

    public $pages;
    public $menuService;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
  public function __construct()
  {
    parent::__construct();
  }
	public function index()
	{
		parent::show();
        $menus = Page::where("slug", "!=", "")->orderBy("menu_sort_order")->get()->toArray();
        $banner = $this->banner;
		$sub_menus = array_filter($menus, function ($menu) {
			return $menu['menu_parent'] != 0;
		});
		$sub_menus = array_values($sub_menus);
		$removed_index = array();
		for( $i = 0; $i<count($menus); $i++)
		{
			foreach( $sub_menus as $sub_menu)
			{
				if($menus[$i]['id'] == $sub_menu['id'])
				{
					$removed_index[] = $i; 
				}
			}
		}
		for($i = 0; $i<count($removed_index);$i++)
		{
			unset($menus[$removed_index[$i]]);
		}
		$menus = array_values($menus);
		for( $i = 0; $i<count($menus); $i++)
		{
			foreach( $sub_menus as $sub_menu)
			{
				if($menus[$i]['id'] == $sub_menu['menu_parent'])
				{
					$menus[$i]['sub_menus'][] = $sub_menu;
				}
			}
		}
		unset($removed_index);
		unset($sub_menus);
		return $this->respond($menus, 'menus.index',  compact('menus', 'banner'));
    }

    public function store()
    {
        $input = Input::all();
        $menus = new MenuService();
        $menus->updateMenus($input['data']);
        return $this->json_response("success", "Menu Updates", null, 200);
    }



}