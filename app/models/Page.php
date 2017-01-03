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
	public function parent() 
	{
		return $this->hasOne('page', 'id', 'menu_parent');
	}

    public function children() 
	{
		return $this->hasMany('page', 'menu_parent', 'id');
    }
	public static function tree() 
	{
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('menu_parent', '=', 0)->where("slug", "!=", "")->orderBy('menu_sort_order')->get()->toArray();

    }
    public function getAll()
    {
        $pages = Page::where("published", '=', '1')->get();
        return $pages; 
    }

    static public function getMenu()
    {
      return Page::where("slug", "!=", "")->orderBy("menu_sort_order")->get();
    }

    public function images()
    {
        return $this->morphMany('Image', 'imageable')->orderBy('asc');
    }
    
    static public function getAllSubNavParents()
    {
		$settings = Setting::first();
		$pages =  Page::where("published", '1')->whereIn('menu_name', array('top','left_side','top,left_side'))->orderBy('menu_sort_order', 'ASC')->get()->toArray(); 
		
		if($settings && is_numeric($settings->portfolio_menu_position))
		{
			// Array position starts from 0 so decrement the value
			$pos = $settings->portfolio_menu_position - 1;
			$portfolio = ['title' => 'Portfolio', 'slug'=>'/portfolio', 'is_portfolio'=>1];

			// Put portfolio at a given position in the menu array.
			// In case of invalid position , portfolio will be pushed at the end of the menu.
			Helpers\ArrayHelper::insertAt($pages, $pos, $portfolio);         
		}
		if($settings && $settings->enable_blog)
		{
			$pos = $settings->blog_menu_position - 1;
			$blog = ['id'=> -1,'title' => $settings->blog_title, 'slug'=>'/posts', 'is_blog' =>1];

			// Put blog after portfolio in the menu array.
			// In case of invalid position , blog will be pushed at the end of the menu.
			Helpers\ArrayHelper::insertAt($pages, $pos, $blog);    
		} 
		return $pages;    
    }    
    
    static public function getSubNavSorted($parent_page_id)
    {
      
      $pages = Page::where("published", '1')->where('menu_name', 'sub_nav')->where('menu_parent','=', $parent_page_id)->orderBy('menu_sort_order', 'ASC')->get();    
      $parent = Page::find($parent_page_id);
      
      $setting = Setting::first();
      if($parent && !$setting->theme)
      {
        $pages->prepend($parent);
      }
      return $pages->toArray();
    }

}