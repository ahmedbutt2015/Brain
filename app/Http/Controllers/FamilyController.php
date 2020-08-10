<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FamilyController extends Controller
{
    //
    public function getAllFamilyWithAddons(){
        $http=new Client();
        $response=$http->request('get',config('app.url').'/api/families');
        $familyaddons = json_decode((string) $response->getBody(), true);
        $data = [
            'category_name' => 'General-Config',
            'page_name' => 'General-Config',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'familyaddons' => $familyaddons

        ];



        return view('admin.general-config')->with($data);

    }
}
