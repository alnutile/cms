<?php


class AdminController extends BaseController {


    public function dash()
    {
        return View::make('admins.dash');
    }
}