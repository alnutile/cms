<?php

class Portfolio extends \Eloquent {

	public static $rules = [
		'title' => 'required',
        'body'  => 'required',
        'slug'  => 'required'
 	];

	protected $fillable = ['title', 'published', 'body', 'slug', 'order'];

    public function scopePublished($query)
    {
        return $query->where("published", "=", 1);
    }

    public function scopeOrderByOrder($query)
    {
        return $query->orderBy('order');
    }
}