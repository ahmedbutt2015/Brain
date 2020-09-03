<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FamilyController extends Controller
{
    //
    public function getAllFamilyWithAddons($id,Request $request){
        $tab = $request->get('tab','1');

        $http=new Client();
        $userId= session('authUser.id');

        $response=$http->request('get',config('app.url').'/api/families?user_id='.$userId.'&system_id='.$id);
        $familyaddons = json_decode((string) $response->getBody(), true);
        
        $data = [
            'category_name' => 'General-Config',
            'page_name' => 'General-Config',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'tab' => $tab,
            'system_id' => $id,
            'system' => $familyaddons['system'],
            'system_data' => json_decode($familyaddons['system']['data'],true),
            'familyaddons' => $familyaddons
        ];
        return view('admin.general-config')->with($data);
    }
    public function getEditSystem($id,Request $request){
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
        return view('BrainPages.editSystem')->with($data);

    }
}
