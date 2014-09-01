<?php


class AdminController extends BaseController {


    public function dash()
    {
      parent::show();
        return View::make('admins.dash');
    }
}