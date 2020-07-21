<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function apisendResetLinkEmail(Request $request)
    {
        $request->validate(['email' =>'required|email']);

        // dd($url);
        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/user-reset-password',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $request->email,
            ],
        ]);

        $info = json_decode((string) $request->getBody(), true);

        // dd($info);

        if($info['status'] == 'success'){
            return redirect()->to(route('login'))->with('message', $info['message']);

        } else{
            return redirect()->back()->with('message', $info['message']);
        }
    }
}