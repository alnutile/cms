<?php

class Portfolio extends BaseModel {

  public static $rules = [
	'category_id' => 'required',
    'title' => 'required',
    'body'  => 'required',
    'slug'  => 'required|unique:portfolios|regex:/^\/[A-Za-z0-9_]+$/'
  ];


  protected $fillable = ['title', 'published', 'body', 'slug', 'order', 'seo', 'header', 'category_id'];

  public function projects()
  {
    return $this->hasMany('Project')->Published()->OrderByOrder();
  }

  static public function allPortfoliosSelectOptions() {
    $ports = self::all();
    $options = [];
    foreach($ports as $port) {
      $options[$port->id] = $port->title;
    }
    return $options;
  }
}