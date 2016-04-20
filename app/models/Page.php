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
      return Page::where("published", '1')->whereIn('menu_name', array('top','left_side','top,left_side'))->get();    
    }    
    
    static public function getSubNavSorted($parent_page_id)
    {
      
      $pages = Page::where("published", '1')->where('menu_name','=', 'sub_nav')->where('menu_parent','=', $parent_page_id)->orderBy('id', 'DESC')->get();    
       $parent = Page::find($parent_page_id);
      if($parent)
      {
        $pages->prepend($parent);
      }
      return $pages;
    }

}