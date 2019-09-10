<?php

class Portfolio_Category extends \Eloquent {
	
	protected $table = 'Portfolio_Categorys';
	
	public static $rules = [
		'name' => 'required'
	];
	
	protected $fillable = ['name'];
	
	
	
}
