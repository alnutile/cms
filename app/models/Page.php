<?php

class Page extends \Eloquent {
    protected $fillable = [];

    public function getAll()
    {
        $pages = Page::where("published", '=', '1')->get();
    }

    static public function getMenu()
    {
        $pages = Page::where("slug", "!=", "")->orderBy("menu_sort_order")->get();
        return $pages;
    }
}