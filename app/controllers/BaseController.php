<?php

class BaseController extends Controller {

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

    public function respond($results, $view, $view_options)
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
            return Response::json(array('data' => $results->toArray(), 'status'=>'success', 'message' => "Page found"), 200);
        }
    }
}