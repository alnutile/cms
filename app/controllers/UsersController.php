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

    public function show($id)
    {
        $user = $this->users->find($id);
        return $user;
    }

    public function edit($params)
    {
        $user = $this->users->find($params['uid']);
        return $user;
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('login')->with('message', 'Your are now logged out!');
    }


    public function updatePassword()
    {

        $validator = Validator::make(Input::all(), array('password' => 'required|confirmed', 'email' => 'required', 'password_confirmation' => 'required'));

        if($validator->passes()) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return $user;
        }
    }

    public function update()
    {
        $validator = Validator::make(Input::all(), array('email' => 'required'));

        if($validator->passes()) {
            $user = User::find(Auth::user()->id);
            $user->email = Input::get('email');
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->admin = Input::get('admin');
            $user->active = Input::get('active');
            $user->save();
            return array('error' => 0, 'data' => $user);
        } else {
            $errors = $validator->errors();
            return $errors;
        }
    }

    public function create()
    {
        $validator = Validator::make(Input::all(), array('password' => 'required|confirmed', 'email' => 'required', 'password_confirmation' => 'required'));

        if($validator->passes()) {
            $user = new User();
            $user->email        = Input::get('email');
            $user->firstname    = Input::get('firstname');
            $user->lastname     = Input::get('lastname');
            $user->admin        = Input::get('admin');
            $user->active       = Input::get('active');
            $user->password     = Hash::make(Input::get('password'));
            $user->save();
            return array('error' => 0, 'data' => $user);
        } else {
            $errors = $validator->errors();
            return $errors;
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