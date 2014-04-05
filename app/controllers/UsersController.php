<?php

class UsersController extends BaseController {

    public $users;

    public function __construct(User $users = null) {
        $this->users    = ($users) ? $users : new User();
        $this->beforeFilter('csrf', array('on'=>'post'));
    }


    public function index()
    {
        if(Auth::guest()) {
            return Response::json(null, 403);
        } else {
            $user = $this->users->all();
            return Response::json($user, 200);
        }
    }

    public function login()
    {
        return View::make('sessions.login');
    }

    public function show($id)
    {
        $user = $this->users->find($id);
        return ")]}',\n" . $user;
    }

    public function edit($params)
    {
        $user = $this->users->find($params['uid']);
        return ")]}',\n" . $user;
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
        $validator = Validator::make(Input::all(), array('email' => 'required|email'));
        $user_update = Input::all();
        if($validator->passes()) {
            $user = User::find($user_update['id']);
            if($user_update['email'] != $user->email) {
                if(User::where("email", 'LIKE', $user_update['email'])) {
                    return ['email' => ["Email is already in the system"]];
                }
            }
            $user->email = $user_update['email'];
            $user->firstname = (isset($user_update['firstname'])) ? $user_update['firstname'] : '';
            $user->lastname = (isset($user_update['lastname'])) ? $user_update['lastname'] : '';
            $user->admin = (isset($user_update['admin'])) ? $user_update['admin'] : 0;
            $user->active = (isset($user_update['active'])) ? $user_update['active'] : 0;
            $user->save();
            return array('error' => 0, 'data' => $user);
        } else {
            $errors = $validator->errors();
            return $errors;
        }
    }


    public function create()
    {
        $user = new User;
        return $user->getFillable();
    }

    public function store()
    {

        $user_post = Input::get('user');
        $validator = Validator::make($user_post, array('password' => 'required|confirmed', 'email' => 'required|email|unique:users', 'password_confirmation' => 'required'));

        if($validator->passes()) {
            $user = new User();
            $user->email        = $user_post['email'];
            $user->firstname    = (isset($user_post['firstname'])) ? $user_post['firstname'] : '';
            $user->lastname     = (isset($user_post['lastname'])) ? $user_post['lastname'] : '';
            $user->admin        = (isset($user_post['admin'])) ? 1 : 0;
            $user->active       = (isset($user_post['active'])) ? 1 : 0;
            $user->password     = $user_post['password'];
            $user->save();
            return $this->json_response('success', "User Saved", $user->toArray(), 200);
        } else {
            $errors = $validator->errors()->toArray();
            return $this->json_response('error', "User Could not be saved", $errors, 422);
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