<?php


use Carbon\Carbon;
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


    public function getImageFromImageableItem($imageable_type, $imageable_id)
    {
        $type = $this->getPathForType($imageable_type);
        $model = $type::findOrFail($imageable_id);
        return Response::json(['data' => $model->images()->getResults()->toArray(), 'message' => "Images"], 200);
    }

    public function getImageForSlug($slug)
    {
        $images = DB::table('images')
            ->Join('posts', 'posts.id', '=', 'images.imageable_id')
            ->leftJoin('projects', 'projects.id', '=', 'images.imageable_id')
            ->leftJoin('pages', 'pages.id', '=', 'images.imageable_id')
            ->where('posts.slug', '=', '/' . $slug)
            ->orWhere('projects.slug', '=', '/' . $slug)
            ->orWhere('pages.slug', '=', '/' . $slug)
            ->get();
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

        $this->setDestinationDir(public_path() . '/assets/img/' . $model);
        $this->checkDestination();
        $this->request = new Request();
        \File::makeDirectory($this->chunkDir, 0777, true, true);
        $this->filename = isset($_FILES['file']) ? $_FILES['file']['name'] : $_GET['flowFilename'];
        if(\Flow\Basic::save($this->getDestinationDir(). '/' . $this->request->getFileName(), $this->config, $this->request)) {
            $storage = $this->getDestinationDir();
            return Response::json(['data' => $this->filename, 'message' => "File Uploaded $storage/$this->filename"], 200);
        } else {
            //Not sure why it needs a 404
            return Response::json([], 404);
        }
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
            File::makeDirectory($this->getDestinationDir(), $mode = 664);
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
        elseif($type == 'projects') {
            $type = 'Project';
            return $type;
        }
    }

}