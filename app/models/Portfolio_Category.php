<?php

class Portfolio_Category extends \Eloquent {
	
	protected $table = 'Portfolio_Category';
	
	public static $rules = [
		'name' => 'required',
		'slug' => 'required|unique:posts|unique:pages|unique:projects|unique:portfolio_category|unique:portfolios|regex:/^\/[A-Za-z0-9_]+$/'
	];
	
	protected $fillable = ['name', 'slug'];
	
	static public function PortfolioCategoryName() {
		$ports = self::all();
		$options = [];
		foreach($ports as $port) {
			$options[$port->id] = $port->name;
		}
		return $options;
	}		
}
