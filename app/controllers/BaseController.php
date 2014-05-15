<?php


class BaseController extends Controller {

    public $settings;
    protected $banner = FALSE;

    public function __construct(Setting $settings = null)
    {
        $this->settings = ($settings == null) ? Setting::first() : $settings;
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
}