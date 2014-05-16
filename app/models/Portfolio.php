<?php

class Portfolio extends BaseModel {

	public static $rules = [
		'title' => 'required',
        'body'  => 'required',
        'slug'  => 'required'
 	];

	protected $fillable = ['title', 'published', 'body', 'slug', 'order'];

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