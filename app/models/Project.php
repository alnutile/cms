<?php

class Project extends BaseModel {

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
        'body',
        'image',
        'tile_image',
        'order',
        'intro',
        'portfolio_id',
        'seo',
        'slug',
        'state_country',
        'city_county'
    ];

    public function portfolio()
    {
        return $this->belongsTo('Portfolio');
    }

    public function images()
    {
        return $this->morphMany('Image', 'imageable')->orderBy('order', 'asc');
    }

    public function tags()
    {
        return $this->morphMany('Tag', 'tagable');
    }

}