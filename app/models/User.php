<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = array('password', 'remember_token');
    protected $fillable = array(
        'username',
        'email',
        'name',
        'password',
        'activated',
    );

    public $rules = array(
        'username' => 'Required|Min:4|Max:24|Alpha_num|unique:users,username',
        'email'     => 'Required|Between:3,64|Email|unique:users,email',
        'name'       => 'Required|Min:4|regex:/^[a-zA-Z\s]*$/',
        'password'  =>'Required|AlphaNum|Between:4,20',
    );

    public $update_rules = array(
        'username' => 'Required|Min:4|Max:24|Alpha_num|unique:users,username',
        'email'     => 'Required|Between:3,64|Email|unique:users,email,',
        'name'       => 'Required|Min:4|regex:/^[a-zA-Z\s]*$/',
        'password'  =>'Required|AlphaNum|Between:4,20',
//        'new_password'  =>'Required|AlphaNum|Between:4,20|confirmed',
        'new_password_confirmation'  =>'Required|AlphaNum|Between:4,20',
    );

    public static $messages = array(
        'regex' => 'Only Alphabetical characters and spaces are allowed.',
    );

    public static function register($data){
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->activated = 0;
        $user->save();
        return $user->id;
    }

    public function validate($data){
        return Validator::make($data, $this->rules);
    }

    public function updateUser($data){
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($data);
        return User::find(Auth::user()->id);
    }
    public static function activate($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(array('activated' => 1));
        return User::find($id);
    }
}
