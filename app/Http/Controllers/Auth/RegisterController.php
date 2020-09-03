<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function apiRegister(Request $request)
    {


        $this->validator($request->all())->validate();

        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/user-register',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);

        $info = json_decode((string) $request->getBody(), true);

        // dd($info);
        if(isset($info['success'])){
            session()->put('authUser', $info['success']['user']); 

            User::createAuth($info['success']['user']);
    
            return redirect('/');
        
        }else{
            return redirect()->to(route('login'))->with('error', 'Unknown Error Occurred');
        }
    }

    
}
