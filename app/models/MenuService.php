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

}