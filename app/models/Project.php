<?php


use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Project extends BaseModel implements StaplerableInterface {
    use EloquentTrait;

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
        'image' => 'mimes:jpeg,bmp,png,gif,jpg',
        'slug'  => 'required|unique:projects|regex:/^\/[A-Za-z0-9_]+$/'
    ];

    // Don't forget to fill this array
    protected $fillable = [
        'title',
        'published',
        'body',
        'image',
        'tile_image',
        'architect',
        'order',
        'intro',
        'portfolio_id',
        'seo',
        'slug',
        'state_country',
        'city_county',
        'thumbs'
   ];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('thumbs', [
            'styles' => [
                'project_top' => '850x650',
                'grid' => '292x292',
                'index' => '182x222'
            ]
        ]);

        parent::__construct($attributes);
    }

    public function portfolio()
    {
        return $this->belongsTo('Portfolio');
    }

    public function images()
    {
        return $this->morphMany('Image', 'imageable')->orderBy('order', 'asc');
    }

    public function tags()
    {
        return $this->morphMany('Tag', 'tagable');
    }



}