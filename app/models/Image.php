<?php

class Image extends \Eloquent {
  protected $fillable = [
    'file_name',
    'image_caption',
    'order',
    'imageable_id',
    'imageable_type'
  ];

  public static $rules = [
    'file_name' => 'required',
    'imageable_id' => 'required',
    'imageable_type'  => 'required',
    'image_caption' =>   'max:400'
  ];

  public function imageable()
  {
    return $this->morphTo();
  }


}