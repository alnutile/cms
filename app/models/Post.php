<?php

class Post extends BaseModel {

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
        'image' => 'mimes:jpeg,bmp,png,gif,jpg',
        'slug'  => 'required|unique:portfolios|regex:/^\/[A-Za-z0-9_]+$/'
    ];

    // Don't forget to fill this array
    protected $fillable = [
        'title',
        'published',
        'intro',
        'body',
        'image',
        'slug'
    ];

    public function images()
    {
        return $this->morphMany('Image', 'imageable')->orderBy('asc');
    }

    public function tags()
    {
        return $this->morphMany('Tag', 'tagable');
    }

}