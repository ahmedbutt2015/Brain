<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    public function updatePass(Request $request)
    {
    //   $request->validate([
    //     'email' => ['required','exists:users,email'],
    //     'password' => ['required', 'string', 'min:8', 'confirmed'],
    //   ]);

      $email = $request->email;
      $token = $request->token;
      $password = $request->password;
    //   dd($token);

        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/user-update-password',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $email,
                'token' => $token,
                'password' => bcrypt($password)
            ],
        ]);

        $info = json_decode((string) $request->getBody(), true);

            // print_r($info);
        if($info['status'] == 'Success'){
            return redirect()->to(route('login'))->with('message', $info['message']);
        }
        else{
            return redirect()->back()->with('message', $info['message']);
        }

    }
}
