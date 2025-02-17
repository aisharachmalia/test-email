<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'usr_nama' => ['required', 'string', 'max:255'],
            'usr_username' => ['required', 'string', 'max:255','unique:users'],
            'usr_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'usr_nama' => $data['usr_nama'],
            'usr_username' => $data['usr_username'],
            'usr_email' => $data['usr_email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registerUser(Request $request){
        // Validator::make($request->all(), [
        //     'usr_nama' => ['required', 'string', 'max:255'],
        //     'usr_username' => ['required', 'string', 'max:255','unique:users'],
        //     'usr_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        return User::create([
            'usr_nama' => $request->usr_nama,
            'usr_username' => $request->usr_username,
            'usr_email' => $request->usr_email,
            'password' => Hash::make($request->password),
        ]);
    }
}
