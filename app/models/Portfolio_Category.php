<?php

class Portfolio_Category extends \Eloquent {
	
	protected $table = 'Portfolio_Category';
	
	public static $rules = [
		'name' => 'required',
		'slug' => 'required'
	];
	
	protected $fillable = ['name', 'slug'];
		
}
