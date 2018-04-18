<?php


use Carbon\Carbon;
use CMS\Services\ImagesService;
use Flow\Config;
use Flow\Request;

/**
 * @TODO DRY up the code
 *
 * Class ImagesController
 */
class ImagesController extends BaseController{


    protected $tempDir;
    protected $destinationDir;
    protected $request;
    protected $filename;
    protected $rand;
    protected $chunkDir;
    protected $config;

    public function __construct(ImagesService $imagesService = null)
    {
        $this->imageservice = $imagesService;
    }


    public function getImageFromImageableItem($imageable_type, $imageable_id)
    {
        $type = $this->getPathForType($imageable_type);
        $model = $type::findOrFail($imageable_id);
        return Response::json(['data' => $model->images()->getResults()->toArray(), 'message' => "Images"], 200);
    }

    public function getImageForSlug($slug)
    {

        $info = $this->getInfoFromSlug($slug);
        $images = DB::table('images')->where('images.imageable_type', '=', $info['type'])->where('images.imageable_id', '=', $info['id'])->get();

        return Response::json(['data' => $this->transformImages($images), 'message' => "Images"], 200);
    }

    public function transformImages($images)
    {
        $img_array = [];
        foreach($images as $key => $image)
        {
            $img_array[$key]['file_name'] = $image->file_name;

        }
        return $img_array;
    }

    public function uploadImage($model)
    {
        $this->setTemp();
		if(! \File::exists(public_path() . '/assets/img/')){
			\File::makeDirectory(public_path() . '/assets/img/', 0777, true, true);
		}
        $this->setDestinationDir(public_path() . '/assets/img/' . $model);
        $this->checkDestination();
        $this->request = new Request();
        \File::makeDirectory($this->chunkDir, 0777, true, true);
        $this->filename = isset($_FILES['file']) ? $_FILES['file']['name'] : $_GET['flowFilename'];

        if(\Flow\Basic::save($this->getDestinationDir(). '/' . $this->request->getFileName(), $this->config, $this->request)) {
            $storage = $this->getDestinationDir();
            Log::debug($storage);
            if($model == 'projects')
            {
                $this->imageservice->cropAndSaveForPages($this->request->getFileName(), $storage);
            }

            if($model == 'pages')
            {
                $this->imageservice->cropAndSaveForPagesTopSlides($this->request->getFileName(), $storage);
            }

            return Response::json(['data' => $this->filename, 'message' => "File Uploaded $storage/$this->filename"], 200);
        } else {
            //Not sure why it needs a 404
            return Response::json([], 404);
        }
    }

    private function getInfoFromSlug($slug)
    {

        $project = DB::table('projects')->where('projects.slug', '=', '/' . $slug);

        $page = DB::table('pages')->where('pages.slug', '=', '/' . $slug);

        $post = DB::table('posts')->where('posts.slug', '=', '/' . $slug);

        $info = [];

        if($project->count() > 0)
        {
            $info['type'] = 'Project';
            $info['id'] = $project->get()[0]->id;
        }
        if($post->count() > 0)
        {
            $info['type'] = 'Post';
            $info['id'] = $post->get()[0]->id;
        }
        if($page->count() > 0)
        {
            $info['type'] = 'Page';
            $info['id'] = $page->get()[0]->id;
        }

        return $info;
    }


    protected function setTemp()
    {
        $this->setTempDir(storage_path());
        $this->rand = Carbon::now()->timestamp;
        $this->chunkDir = $this->getTempDir() . DIRECTORY_SEPARATOR . $this->rand;
        $this->config = new Config(array(
            'tempDir' => $this->chunkDir
        ));
    }

    protected function flowSave()
    {
        if(\Flow\Basic::save($this->getDestinationDir(). '/' . $this->request->getFileName(), $this->config, $this->request)) {
            $storage = $this->getDestinationDir();
            return Response::json(['data' => $this->filename, 'message' => "File Uploaded $storage/$this->filename"], 200);
        } else {
            //Not sure why it needs a 404
            return Response::json([], 404);
        }
    }

    /**
     * @param mixed $tempDir
     * @return $this
     */
    public function setTempDir($tempDir)
    {
        $this->tempDir = $tempDir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempDir()
    {
        return $this->tempDir;
    }

    /**
     * @return mixed
     */
    public function getDestinationDir()
    {
        return $this->destinationDir;
    }

    /**
     * @param mixed $destinationDir
     * @return $this
     */
    public function setDestinationDir($destinationDir)
    {
        $this->destinationDir = $destinationDir;
        return $this;
    }

    public function checkDestination()
    {
        if(!File::exists($this->getDestinationDir())) {
              \File::makeDirectory($this->getDestinationDir(), $mode = 0777, true, true);
        }
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Image::destroy($id);

        return Response::json(['data' => [], 'message' => "Image Deleted"], 200);
    }

    protected function getPathForType($type)
    {
        if($type == 'posts')
        {
            $type = 'Post';
            return $type;
        }
        if($type == 'projects')
        {
            $type = 'Project';
            return $type;
        }
        if($type == 'pages')
        {
            $type = 'Page';
            return $type;
        }
        elseif($type == 'projects') {
            $type = 'Project';
            return $type;
        }
    }

}