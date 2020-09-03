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

        // return redirect()->to(route('template'));
                return redirect()->to(route('generalSetting'));
    }
    public function editnewSystem(Request $request)
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

        Session::put('formDataEdit', $request->all());

        // return redirect()->to(route('template'));
                return redirect()->to(route('general-config',[$request->id]));
    }
    
    public function storeSystemAddon(Request $request){
   
    Session::put('formDataAddon', $request->all());
            return redirect()->to(route('template'));
    }
    public function editSystemAddon(Request $request){
    
        Session::put('formDataAddonEdit', $request->all());
        $data = Session::get('formDataEdit');
        $id = $data['id'];
        
        $http=new Client();
        $userId= session('authUser.id');
        $response=$http->request('get',config('app.url').'/api/editSystem/'.$id);  
        $editSystem = json_decode((string) $response->getBody(), true);
        $data = [
            'category_name' => 'Edit-System',
            'page_name' => 'Edit-System',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
             'editSystem'=> $editSystem
        ]; 
        return view('BrainPages.editTemplate')->with($data);

        }
    

    public function storeSystem(Request $request)
    {
        // Session::flush();
        if(session()->has('formData')){
            $request->validate([
                'template' => 'required'
            ]);

           
            $data = Session::get('formData');
            $dataAddon = Session::get('formDataAddon');      
                
            $data['template'] = $request->template;
            $data['user_id'] = Session::get('authUser')['id'];

            $http = new Client();
            try{
            $request = $http->request('POST',config('app.url').'/api/store-system',[
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'formData' => $data,
                    'formDataAddon' =>$dataAddon,
                    'userId'=>$data['user_id']
                ],
            ]);
            $info = json_decode((string) $request->getBody(), true);
            
            
            if($info['status']== 'Success'){
                Session::forget('formData');
                session::forget('lastSystem');
                // return redirect()->to(url('general-config/'.$info['system_id']))->with('success','Customer Added!');
                return redirect('/system')->with('success','System Created Successfully!');
            }
            else{
                return redirect()->to(url('new-system'))->with('error',$info['message']);
            }
            }catch(\GuzzleHttp\Exception\ServerException $e){
                dd($e->getMessage());
return redirect()->to(url('new-system'))->with('error','Credentials was wrong! Couldn\'t connect to Ftp system.');                
                
            }

            

        }
        else{
            return redirect()->to(url('new-system'))->with('fill','Enter Customer details first to choose a template!');
        }
    }
    public function updateStoreSystem(Request $request){

        $data = Session::get('formDataEdit');
        $dataAddon = Session::get('formDataAddonEdit');                 
        $data['template'] = $request->template;
        $data['user_id'] = Session::get('authUser')['id'];
        $http = new Client();
        
        $request = $http->request('PUT',config('app.url').'/api/update-store-system',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'formData' => $data,
                'formDataAddon' =>$dataAddon,
                'userId'=>$data['user_id']
            ],
        ]);
        $info = json_decode((string) $request->getBody(), true);
        if($info['status']== 'Success'){
            Session::forget('formDataEdit');
            session::forget('formDataAddonEdit');
            return redirect('/system')->with('success','System Updated!');
        }
        else{
            return redirect()->to(url('new-system'))->with('error',$info['message']);
        }
    
}
public function restoreSystem($id,Request $request)
    {
        // Session::flush();
           
            $data['system_id'] = $id;
            $data['user_id'] = Session::get('authUser')['id'];

            $http = new Client();
            try{
            $request = $http->request('POST',config('app.url').'/api/restore-system',[
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
                return redirect()->to(url('general-config/'.$info['system_id']))->with('success','System re-published!');
            }
            else{
                return redirect()->back()->with('error',$info['message']);
            }
            }catch(\GuzzleHttp\Exception\ServerException $e){
return redirect()->back()->with('error','Credentials was wrong! Couldn\'t connect to Ftp system.');                
                
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
    public function saveLanguageCurrency(Request $request){
        $userId= session('authUser.id');
        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/save-language-currency',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'language' => isset($request->language)?$request->language:NULL,
                'currency' => isset($request->currency)?$request->currency:NULL,
                'userId' => $userId,
            ],
        ]);
       return $info = json_decode((string) $request->getBody(), true);
    }
}
