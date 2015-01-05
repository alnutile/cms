<?php

class TagsController extends \BaseController {

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


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

//    private function transformCollection($tags)
//    {
//
//        return array_map([$this, 'transform'], $tags);
//    }

    private function transformCollection($tags)
    {
        $tags_array = [];
        foreach($tags as $key => $tag)
        {
            $tags_array[$key] = $tag['name'];
        }
        return $tags_array;
    }


    private function transform($tags)
    {
            return [
                'name' => $tags['name']
            ];
    }



}
