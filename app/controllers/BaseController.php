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
}