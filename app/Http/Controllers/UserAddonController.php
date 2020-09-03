<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Auth;
class UserAddonController extends Controller
{
    //
    public function store(Request $request){
            $addons=[];

                foreach ($request->input('addons',[]) as $key => $value) {
                    $addons[] = $value;
            }

       $userId= session('authUser.id');

        $http = new Client();
        $request = $http->request('POST', config('app.url').'/api/save-useraddon',[
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'addons' => $addons,
                'userId' => $userId,
                'system_id' => $request->system_id,
                'user_name_list' => $request->user_name_list,
                'user_name_single' => $request->user_name_single,
                'contact_name_list' => $request->contact_name_list,
                'contact_name_single' => $request->contact_name_single,
                'language' => $request->language,
                'currency' => $request->currency,
            ],
        ]);
        $info = json_decode((string) $request->getBody(), true);
return back();
    }
}
