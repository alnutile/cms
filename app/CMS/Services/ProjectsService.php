<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 8/7/14
 * Time: 4:53 AM
 */

namespace CMS\Services;

use CMS\Services\ImagesService;

class ProjectsService {


  /**
   * @var ImagesService
   */
  private $imagesService;

  public function __construct(ImagesService $imagesService)
  {
    $this->imagesService = $imagesService;
  }

  public function addImages($model_id, array $images, $class_name) {
    return $this->imagesService->addImages($model_id, $images, $class_name);
  }


}