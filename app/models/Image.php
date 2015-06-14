<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Image extends \Eloquent implements StaplerableInterface {
    use EloquentTrait;

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


    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

  public function imageable()
  {
    return $this->morphTo();
  }


}