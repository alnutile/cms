<?php

use CMS\Services\TagsService;

class TagsController extends \BaseController {
    protected $tagable_id;
    protected $tagable_type;
    protected $tagName;
    protected $type;

    Public function __construct(TagsService $tagsService)
    {
        $this->tags = $tagsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $tags = Post::find($id)->tags;
        return $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function all_tags($tagable_type)
    {
        $type = $this->tags->getType($tagable_type);
        $data =  $this->tags->get_tags_for_type($type);
        $tags = $this->tags->transformTags($data->toArray());
        return Response::json([
                'data' => $tags,
                'message' => "Tags"],
            200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function get_tags($tagable_type, $id)
    {
        $type = $this->tags->getType($tagable_type);
        $model = $type::findOrFail($id);
        return Response::json([
            'data' => $this->tags->transformCollection($model->tags()->getResults()->toArray()), 'message' => "tags"], 200);
    }

    /**
     * Delete a resource from storage.
     *
     * @return Response
     */
    public function delete_tag_by_name()
    {
        $tags = $this->tags->getInput();
        DB::table('tags')->where('tagable_id', '=', $tags['tagable_id'])->where('tagable_type','=',$tags['tagable_type'])->where('name','=',$tags['tagName'])->delete();
        return Response::json([
            'data' => $tags['tagName'], 'message' => "deleted"], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $tags = $this->tags->getInput();
        $data = [
            'name' => $tags['tagName'],
            'tagable_id' => $tags['tagable_id'],
            'tagable_type' => $tags['tagable_type']
        ];
        return Tag::create($data);
    }


    public function autocomplete_tags($type, $query)
    {
        $type = $this->tags->getType($type);
        $data =  $this->tags->get_tags_autocomplete($type, $query);
        $tags = $this->tags->transformCollection($data);
        return Response::json([
                'data' => $tags,
                'message' => "Tags"],
            200);
    }







}
