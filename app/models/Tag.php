<?php

class Tag extends \Eloquent {

    protected $fillable = [
        'name',
        'tagable_id',
        'tagable_type'
    ];

    public function posts()
    {
        return $this->morphedByMany('Post', 'tagable');
    }

    public function projects()
    {
        return $this->morphedByMany('Project', 'tagable');
    }

    public static $rules = [
        'name' => 'required',
        'tagable_id' => 'required',
        'tagable_type'  => 'required',
    ];

}