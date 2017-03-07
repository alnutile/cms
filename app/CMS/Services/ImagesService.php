<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 8/7/14
 * Time: 4:53 AM
 */

namespace CMS\Services;

use Illuminate\Support\Facades\Log;
use \Image;

class ImagesService {
    protected $rules;

    /**
     * @var Image
     */
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }


    public function addImages($id, array $images, $type)
    {
        foreach($images as $image)
        {
            //@TODO add catch here
            $file_name = $image['file'];
            $caption = $image['image_caption'];
            $order = $image['order'];
            $this->add_image($file_name, $id, $type, $caption, $order);
        }
    }

    public function add_image($image_name, $imageable_id, $imageable_type, $caption, $order)
    {
        $data = [
            'file_name' => $image_name,
            'imageable_id' => $imageable_id,
            'imageable_type' => $imageable_type,
            'image_caption' => $caption,
            'order' => $order
        ];

        $validator = \Validator::make($data, $this->getRules());
        if($validator->fails())
        {
            throw new \Exception($validator);
        }
        return $this->image->create($data);
    }


    public function remove_image($image_name, $imageable_id, $imageable_type, $image_caption)
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
            $rules = \Image::$rules;
        }
        $this->rules = $rules;
        return $this;
    }

    public function cropAndSaveForPost($origImage, $path)
    {
        $image = \Intervention\Image\Facades\Image::make($origImage->getRealPath());
        $file = ($origImage->getClientOriginalName());
        $image->save($path . $file)
            ->resize(1000, null,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})
            ->crop(280, 340)
            ->save($path . '/thumb/' . $file);
    }
	public function resizeAndSaveForPost($origImage, $path)
    {
        $image_thumb = \Intervention\Image\Facades\Image::make($origImage->getRealPath());
		list($width, $height) = getimagesize($origImage->getRealPath());
		$file = ($origImage->getClientOriginalName());
		if($width > 280){
			$image_thumb->resize(280, null,  function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->save($path . '/thumb/' . $file);
		}
		$image_full = \Intervention\Image\Facades\Image::make($origImage->getRealPath());
		list($width_full, $height_full) = getimagesize($origImage->getRealPath());
		if($width_full > 850){
			$image_full->resize(850, null,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
			})->save($path . '/full/' . $file);
		}
    }

    public function cropAndSaveForPagesTopSlides($origImage, $path)
    {
        Log::info($path);
        $image = \Intervention\Image\Facades\Image::make($path . '/' . $origImage);
        $image->resize(850, null,  function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();})
            ->crop(850, 360)
            ->save($path . '/slideshow2/' . $origImage);
    }


    public function cropAndSaveForPages($origImage, $path)
    {
        Log::info($path);
        $image = \Intervention\Image\Facades\Image::make($path . '/' . $origImage);
        $image->resize(850, null,  function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();})
            ->save($path . '/gallery/' . $origImage);
    }


} 