<?php

class Portfolio_Category extends \Eloquent {
	
	protected $table = 'Portfolio_Category';
	
	public static $rules = [
		'name' => 'required',
		'desc' => 'required',
		'slug' => 'required|unique:secondary_posts|unique:posts|unique:pages|unique:projects|unique:portfolio_category|unique:portfolios|regex:/^\/[A-Za-z0-9_]+$/'
	];
	
	protected $fillable = ['name','desc','body','slug','sort_order'];
	
	static public function PortfolioCategoryName() {
		$ports = self::where('is_active', 1)->get();
		$options = [];
		foreach($ports as $port) {
			$options[$port->id] = $port->name;
		}
		return $options;
	}		
}
