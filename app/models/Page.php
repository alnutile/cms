<?php

class Page extends \Eloquent {
    protected $fillable = [
        'title',
        'body',
        'published',
        'slug',
        'seo',
        'menu_sort_order',
        'menu_parent',
        'menu_name',
        'redirect_url'
    ];

    public function getAll()
    {
        $pages = Page::where("published", '=', '1')->get();
    }

    static public function getMenu()
    {
        $pages = Page::where("slug", "!=", "")->orderBy("menu_sort_order")->get();
        return $pages;
    }

    public function images()
    {
        return $this->morphMany('Image', 'imageable')->orderBy('asc');
    }

}