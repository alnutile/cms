<?php

class Project extends BaseModel {

  // Add your validation rules here
  public static $rules = [
    'title' => 'required',
    'image' => 'mimes:jpeg,bmp,png,gif,jpg'
  ];

  // Don't forget to fill this array
  protected $fillable = [
    'title',
    'published',
    'body',
    'image',
    'order',
    'intro',
    'portfolio_id',
    'seo',
    'slug'
  ];

  public function portfolio()
  {
    return $this->belongsTo('Portfolio');
  }

}