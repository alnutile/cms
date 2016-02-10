<?php

class Page extends \Eloquent {
   
	// Added by John B 2-5-2016 - missing rules array
    public static $rules = array(
        'title' => 'required',
        'seo'   => 'required',
        //'image' => 'mimes:jpg,jpeg,bmp,png,gif',
        'slug'  => 'required'
    );
    // Moved this section down to match Posts model
     protected $fillable = [
        'title',
        'seo',
        'body',
        'slug',
        'published',
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