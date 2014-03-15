<?php

class UsersController extends BaseController {

    public $users;
    public function __construct(User $users = null) {
        $this->users    = ($users) ? $users : new User();
        $this->beforeFilter('csrf', array('on'=>'post'));
    }


    public function index()
    {
        $user = $this->users->all();
        return $user;
    }

    public function login()
    {
        return View::make('sessions.login');
    }

    public function edit()
    {
        $user = Auth::user();
        return View::make('user.edit', compact('user'));
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('login')->with('message', 'Your are now logged out!');
    }

    public function update()
    {
        $validator = Validator::make(Input::all(), array('password' => 'required|confirmed', 'email' => 'required', 'password_confirmation' => 'required'));

        if($validator->passes()) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::to('users/edit')->with('message', 'Your info has been updated')->withInput();
        } else {
            return Redirect::to('users/edit')->with('message', 'There was an error')->withInput()->withErrors($validator);
        }
    }

    public function authenticate()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            return Redirect::to('admin')->with('message', 'You are now logged in!');
        } else {
            Session::set('type', 'danger');
            return Redirect::to('login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }
    }
}