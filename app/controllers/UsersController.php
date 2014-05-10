<?php

class UsersController extends BaseController {

    public $users;

    public function __construct(User $users = null) {
        parent::__construct();
        $this->users    = ($users) ? $users : new User();
        $this->beforeFilter("auth", ['except' => ['login', 'getLogout', 'authenticate']]);
        $this->beforeFilter('csrf', array('on'=>'post'));
    }


    public function index()
    {
        $users = $this->users->all();
        $banner = $this->banner;
        return $this->respond($users, 'users.index',  compact('users', 'banner'));
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

    public function edit($id)
    {
        $user = $this->users->find($id);
        return View::make('users.edit', compact('user'));
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

    public function update($id)
    {
        $user_update = Input::all();
        $password = false;
        if(isset($user_update['reset']) && $user_update['reset'] == 'on') {
            $validator = Validator::make(Input::all(), array('email' => 'required|email', 'password' => 'confirmed|min:8'));
            $password  = Hash::make($user_update['password']);
        } else {
            $validator = Validator::make(Input::all(), array('email' => 'required|email'));
        }
        $banner = $this->banner;
        $user = User::find($id);
        if($validator->passes()) {
            if($user_update['email'] != $user->email) {
                if(User::where("email", 'LIKE', $user_update['email'])) {
                    return ['email' => ["Email is already in the system"]];
                }
            }
            $user->email            = $user_update['email'];
            $user->firstname        = (isset($user_update['firstname'])) ? $user_update['firstname'] : '';
            $user->lastname         = (isset($user_update['lastname'])) ? $user_update['lastname'] : '';
            $user->admin            = (isset($user_update['admin'])) ? $user_update['admin'] : 0;
            $user->active           = (isset($user_update['active'])) ? $user_update['active'] : 0;
            $user->password         = (isset($user_update['password'])) ? $password : $user->password;
            $user->save();
            return Redirect::to("users/" . $user->id)->withMessage("User Updated");
        } else {

            return Redirect::to('users/' . $user->id . '/edit')->withErrors($validator)
                ->withMessage("Error ")
                ->withInput(Input::except('password'));
        }
    }


    public function create()
    {
        $user = new User();
        return View::make('users.create', compact('user'))->withMessage("Create User");
    }

    public function store()
    {
        $banner = $this->banner;
        $validator = Validator::make($data = Input::all(), User::$rules);
        $user = new User;
        if($validator->passes()) {
            $user->email        = $data['email'];
            $user->firstname    = (isset($data['firstname'])) ? $data['firstname'] : '';
            $user->lastname     = (isset($data['lastname'])) ? $data['lastname'] : '';
            $user->admin        = (isset($data['admin'])) ? 1 : 0;
            $user->active       = (isset($data['active'])) ? 1 : 0;
            $user->password     = Hash::make($data['password']);
            $user->save();
            return Redirect::to("users")->withMessage("User Created");
        } else {
            return Redirect::to('users/create')->withErrors($validator)
                ->withMessage("Error creating user")
                ->withInput(Input::except('password'));
        }
    }


    public function authenticate()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            return Redirect::to('/admin')->with('message', 'You are now logged in!');
        } else {
            Session::set('type', 'danger');
            return Redirect::to('login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }
    }
}