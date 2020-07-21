<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Auth;
use App\System;
use Session;

class UserActionApiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['remoteAuth','web']);
    }

    public function viewSystem()
    {
        $http = new Client();
        $request = $http->request('POST',config('app.url').'/api/get-systems',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'id' => Session::get('authUser')['id'],
                'email' => Session::get('authUser')['email'],
                'password' =>Session::get('authUser'),
            ],
        ]);

        $info = json_decode((string) $request->getBody(), true);

        $data = [
            'category_name' => 'dashboard',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

        ];

        return view('BrainPages.system')->with('customers', $info['customers'])->with($data);
    }

    public function newSystem(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'type' => 'required',
            'ftpserver' => 'required',
            'ftpdoor' => 'required',
            'ftpuser' => 'required',
            'ftppass' => 'required',
            'ftpfolder' => 'required',
        ]);

        Session::put('formData', $request->all());

        return redirect()->to(route('template'));
    }

    public function storeSystem(Request $request)
    {
        // Session::flush();
        if(session()->has('formData')){
            $request->validate([
                'template' => 'required'
            ]);

           
            $data = Session::get('formData');
            $data['template'] = $request->template;
            $data['user_id'] = Session::get('authUser')['id'];
            
            $http = new Client();
            try{
            $request = $http->request('POST',config('app.url').'/api/store-system',[
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'formData' => $data
                ],
            ]);
            $info = json_decode((string) $request->getBody(), true);

            
            if($info['status']== 'Success'){
                Session::forget('formData');
                return redirect()->to(route('api-system'))->with('success','Customer Added!');
            }
            else{
                return redirect()->to(url('new-system'))->with('error',$info['message']);
            }
            }catch(\GuzzleHttp\Exception\ServerException $e){
return redirect()->to(url('new-system'))->with('error','Credentials was wrong! Couldn\'t connect to Ftp system.');                
                
            }

            

        }
        else{
            return redirect()->to(url('new-system'))->with('fill','Enter Customer details first to choose a template!');
        }
    }

    public function viewHistory()
    {
        // echo (config/('app.url').'/api/get-history');
        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/get-history',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'id' => Session::get('authUser')['id']
            ],
        ]);

        $info = json_decode((string) $request->getBody(), true);

        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'History',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

        ];
        return view('BrainPages.history')->with('histories',$info['histories'])->with($data);
    }
}
