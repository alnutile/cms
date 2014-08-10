<?php

class Image extends \Eloquent {
	protected $fillable = [
        'file_name',
        'imageable_id',
        'imageable_type'
    ];

    public static $rules = [
        'file_name' => 'required',
        'imageable_id' => 'required',
        'imageable_type'  => 'required',
    ];
}