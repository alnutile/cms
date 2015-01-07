<?php

class TagsController extends \BaseController {
    protected $tagable_id;
    protected $tagable_type;
    protected $tagName;

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
        $data =  Tag::where('tagable_type', '=', $tagable_type)->get();
        return Response::json([
                'data' => $this->transformCollection($data->toArray()),
                'message' => "Images"],
            200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function get_tags($type, $id)
    {
        $model = $type::findOrFail($id);
        return Response::json([
            'data' => $this->transformCollection($model->tags()->getResults()->toArray()), 'message' => "tags"], 200);
    }

    public function delete_tag_by_name()
    {
        $this->getInput();
        DB::table('tags')->where('tagable_id', '=', $this->tagable_id)->where('tagable_type','=',$this->tagable_type)->where('name','=',$this->tagName)->delete();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->getInput();
        $data = [
            'name' => $this->tagName,
            'tagable_id' => $this->tagable_id,
            'tagable_type' => $this->tagable_type
        ];
        return Tag::create($data);
    }


    private function transformCollection($tags)
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
            $data = $content->get('data');
            $this->tagName = $data['tag'];
            $this->tagable_type = $data['type'];
            $this->tagable_id = $data['pageId'];


        } catch(\Exception $e)
        {
            return \Response::json(['data' => $e->getMessage(), 'message' => "tags"],  422);
        }
    }



}
