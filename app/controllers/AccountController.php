<?php

class AccountController extends BaseController {

    public function __construct()
    {
        if (!Session::has('logged'))
        {
            Redirect::to('index');
        }
    }

    public function register()
    {
        return View::make('account/register');
    }

    public function register_action()
    {
        $user = new User();
        $validate = $user->validate(Input::all());
        $data = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'username' => Input::get('username'),
        );

        if($validate->fails()){
            return Redirect::to('register')->withInput()->withErrors($validate,'register');
        }
        $created_id = (User::register($data));

        Session::flash('success', Config::get('constants.REG_OK'));

        Mail::send(
            'emails.confirmation',
            array('name'=> Input::get('name'), 'username'=> Input::get('username'), 'id' => $created_id),
            function($message){
                $message->to('jay.co@klab.com',Input::get('name'))->subject(Config::get('constants.REG_OK'));
            }
        );
        return Redirect::to('register');
    }

    public function activate()
    {
        $user = User::activate(Input::get('id'));
        Auth::login($user);
        return Redirect::to('mypart');
    }

    public function test()
    {
        $user = User::find(14);
        Session::put('logged', $user);

    }

    public function login_action()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password'))))
        {
            if(Auth::user()->activated == 0){
                Auth::logout();
                Session::flash('invalid', Config::get('constants.LOGIN_NAC'));
                return Redirect::to('');
            }
            return Redirect::to('mypart');
        } else{
            Session::flash('invalid', Config::get('constants.LOGIN_NOK'));
            return Redirect::to('');
        }

    }

    public function logout_action()
    {
        Auth::logout();
        return Redirect::to('');
    }

    public function test2()
    {
//        if (Auth::attempt(array('email'=>'jay.co@klab.com', 'password'=>'password')))
//        {
//            return 'Tama';
//        } else{
//            return 'aw';
//        }
        return Blog::test();
    }

    public function profile()
    {
        if(!Auth::check()){
            return Redirect::to('');
        }
        return View::make('account/profile');
    }

    public function profile_action()
    {
        $user_id = Auth::user()->id;
        $user = new User();
        $user->rules['email'] =  "Required|Between:3,64|Email|unique:users,email,$user_id";
        $user->rules['username'] =  "Required|Min:4|Max:24|Alpha_num|unique:users,username,$user_id";
        $user->rules['new_password'] = 'AlphaNum|Between:4,20|confirmed';

        $validate = $user->validate(Input::all());
        if($validate->fails()) {
            return Redirect::to('profile')->withInput()->withErrors($validate,'profile');
        }
        $current_user = User::find($user_id);

        if(Hash::check(Input::get('password'), $current_user['password'])) {
            $data = array(
                'name' => Input::get('name'),
                'username' => Input::get('username'),
                'email' => Input::get('email'),
            );

            if(!Input::get('new_password')== "") {
                $data['password'] = Hash::make(Input::get('new_password'));
            }
            $user->updateUser($data);
            Session::flash('success', Config::get('constants.PROFILE_OK'));
            return Redirect::to('profile');
        } else {
            Session::flash('invalid', Config::get('constants.PROFILE_NOK'));
            return Redirect::to('profile');
        }
    }

}
