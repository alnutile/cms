<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 8/7/14
 * Time: 4:53 AM
 */

namespace CMS\Services;


use Illuminate\Support\Facades\DB;
use Request;
use Tag;

class TagsService {


    protected $rules;
    protected $tagable_id;
    private $tag;

    public function __construct()
  {

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
        return Tag::create($data);
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

    public function get_tags_for_type($tagable_type)
    {
        $tagsData =  Tag::where('tagable_type', '=', $tagable_type)->get();
        $tags = $this->transformTags($tagsData->toArray());
        return $tags;
    }


    public function transformCollection($tags)
    {
        $tags_array = [];
        foreach($tags as $key => $tag)
        {
            $tags_array[$key]['text'] = $tag['name'];
        }
        return $tags_array;
    }

    public function getInput()
    {
        try {
            $request = Request::instance();
            $content = $request->json();
            $payload = $content->get('data');
            $data = [];
            $data['tagName'] = $payload['tag'];
            $data['tagable_type'] = $this->getType($payload['type']);
            $data['tagable_id'] = $payload['pageId'];
            return $data;

        } catch(\Exception $e)
        {
            return \Response::json(['data' => $e->getMessage(), 'message' => "tags"],  422);
        }
    }

    public function getType($tagable_type)
    {
        if($tagable_type == 'posts')
        {
            $tagable_type = 'Post';
            return $tagable_type;
        }
        elseif($tagable_type == 'projects') {
            $tagable_type = 'Project';
            return $tagable_type;
        }

    }

    public function getPathForType($tagable_type)
    {
        if($tagable_type == 'Post')
        {
            $tagable_type = 'posts';
            return $tagable_type;
        }
        elseif($tagable_type == 'Project') {
            $tagable_type = 'projects';
            return $tagable_type;
        }

    }

    public function transformTags($tagsData)
    {
        $tags_array = [];
        foreach($tagsData as $key => $tag)
        {
            $tags_array[$key]['tag'] = $tag['name'];
            $tags_array[$key]['tagable_type'] = $this->getPathForType($tag['tagable_type']);
            $tags_array[$key]['tagable_id'] = $tag['tagable_id'];
            $tags_array[$key]['tag_id'] = $tag['id'];
        }
        return $tags_array;
    }





}