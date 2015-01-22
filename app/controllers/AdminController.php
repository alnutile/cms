<?php


class AdminController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }
    public function dash()
    {
      parent::show();
        return View::make('admins.dash');
    }
}