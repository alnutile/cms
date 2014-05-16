<?php

use Symfony\Component\Filesystem\Filesystem;

class BaseController extends Controller {

    protected $filesystem;
    public $settings;
    public $portfolio;
    protected $banner = FALSE;

    public function __construct(Setting $settings = null, Portfolio $portfolio = null, Filesystem $filesystem = null)
    {
        $this->settings = ($settings == null) ? Setting::first() : $settings;
        $this->portfolio = ($portfolio == null) ? Portfolio::all() : $portfolio;
        $this->filesystem = ($filesystem == null) ? new Filesystem : $filesystem;
        \View::share('settings', $this->settings);
    }
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function json_response($status, $message, $data, $code) {
        return Response::json(['status' => $status, 'message' => $message, 'data' => $data], $code);
    }

    public function respond($results, $view, $view_options, $message = null)
    {
        if(Request::format() == 'html') {
            if(!$results) {
                return View::make('404');
            }
            return View::make($view, $view_options);
        } else {
            if(!$results) {
                return Response::json(null, 404);
            }
            return Response::json(array('data' => $results->toArray(), 'status'=>'success', 'message' => "Success"), 200);
        }
    }

    public function bannerSet($page)
    {
        if (isset($page) && $page->slug === '/home') {
            $banner = TRUE;
        } else {
            $banner = FALSE;
        }
        return $banner;
    }

    public function getPortfolioBlock()
    {
        return Portfolio::allActiveSorted();
    }

    public function uploadFile($data, $field_name)
    {
        //Only run when an image
        if($data[$field_name])
        {
            $image = $data[$field_name];
            $filename = $image->getClientOriginalName();
            $destination = $this->save_to;

            if(!$this->filesystem->exists($destination)) {
                $this->filesystem->mkdir($destination);
            }
            try {
                $image->move($destination, $filename);
                $data[$field_name] = $filename;
            } catch(\Exception $e) {
                throw new \Exception("Error uploading file $field_name" . $e->getMessage());
            }
        }
        return $data;
    }

    public function checkPublished($data)
    {
        if(!isset($data['published'])) {
            $data['published'] = 0;
        }

        return $data;
    }

}