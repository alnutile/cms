<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 8/7/14
 * Time: 4:53 AM
 */

namespace CMS\Services;


use Tag;

class TagsService {


    protected $rules;
    private $tag;

    public function __construct(Tag $tag)
  {
    $this->tag = $tag;
  }

    public function addTags($id, array $tags, $type)
    {
        foreach($tags as $tag)
        {
            //@TODO add catch here
            $tag_name = $tag['tag'];
            $this->add_tag($tag_name, $id, $type);
        }
    }

    public function add_tag($tag_name, $tagable_id, $tagable_type)
    {
        $data = [
            'name' => $tag_name,
            'tagable_id' => $tagable_id,
            'tagable_type' => $tagable_type
        ];

        $validator = \Validator::make($data, $this->getRules());
        if($validator->fails())
        {
            throw new \Exception($validator);
        }
        return $this->tag->create($data);
    }


    public function remove_tags($tag_name, $tagable_id, $tagable_type)
    {

    }

    public function getRules()
    {
        if(null == $this->rules)
        {
            $this->setRules();
        }
        return $this->rules;
    }

    public function setRules($rules = array())
    {
        if(null === $rules)
        {
            $rules =  Tag::$rules;
        }
        $this->rules = $rules;
        return $this;
    }




}