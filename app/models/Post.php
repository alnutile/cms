<?php

class Post extends BaseModel {

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
        'image' => 'mimes:jpg,jpeg,bmp,png,gif',
        'slug'  => 'required|unique:portfolios|regex:/^\/[A-Za-z0-9_]+$/',
        'seo'   => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = [
        'title',
        'published',
        'intro',
        'body',
        'image',
        'slug',
        'seo'
    ];

    public function images()
    {
        return $this->morphMany('Image', 'imageable');
    }

    public function tags()
    {
        return $this->morphMany('Tag', 'tagable');
    }

}