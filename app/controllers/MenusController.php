<?php

class MenusController extends \BaseController {

    public $pages;
    public $menuService;

    public function __construct(Page $pages = null, MenuService $menuService = null)
    {
        parent::__construct();
        $this->beforeFilter("auth", array('only' => ['index', 'store']));
        $this->pages            = ($pages == null) ? new Page : $pages;
        $this->menuService      = ($menuService == null) ? new MenuService() : $menuService;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $menus = $this->pages->getMenu();
        $banner = $this->banner;
        return $this->respond($menus, 'menus.index',  compact('menus', 'banner'));
    }

    public function store()
    {
        $input = Input::all();
        $this->menuService->updateMenus($input['data']);
        return $this->json_response("success", "Menu Updates", null, 200);
    }

}