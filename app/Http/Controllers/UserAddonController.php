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

                foreach ($request->input('addons') as $key => $value) {
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
            ],
        ]);
        $info = json_decode((string) $request->getBody(), true);
return redirect('general-config');
    }
}
