<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPThumb\GD;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \App\Http\Requests\UserRequest  $data
     * @return \App\User
     */
    protected function create ( UserRequest $data )
    {
        $user = User::create([
            'role' => 'user',
            'name' => $data->name,
            'lastname' => $data->lastname,
            'nick' => $data->nick,
            'email' => $data->email,
            'password' => Hash::make($data['password'])
        ]);
        
        if ( $data->file('avatar') ) {
            $user->avatar = $data->file('avatar')->store('avatars', 'public');
            $user->save();
        }
        else
        {
            $user->avatar = 'avatars/default-avatar.jpg';
            $user->save();
        }
    
        return $user;
    }
}
