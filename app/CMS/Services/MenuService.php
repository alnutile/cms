<?php

Class MenuService {

    protected $pageModel;

    public function __construct(Page $pageModel = null)
    {
        $this->pageModel = ($pageModel == null) ? new Page : $pageModel;
    }

    public function updateMenus($updates)
    {
        if(count($updates)) {
            $count = 1;
            foreach($updates as $menu) {
                $id         = $menu['pageId'];
                $parent     = $menu['pageMenuParent'];
                $menu_name  = $menu['menuLocation'];
                $page = Page::findOrFail($id);
                $page->menu_parent      = $parent;
                $page->menu_name        = $menu_name;
                $page->menu_sort_order  = $count;
                $page->save();
                $count++;
            }
        }
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
        if (isset($page) && $page->slug === '/home') {
            $banner = TRUE;
        } else {
            $banner = FALSE;
        }
        $settings = $this->settings;
        return $this->respond($page, 'pages.show',  compact('page', 'banner'));
    }

}