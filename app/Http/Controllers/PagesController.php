<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Log;
use App\System;
use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('remoteAuth');
    }

    public function index()
    {
        return view('home');
    }

    /**
     * Show the New system Form view.
     *
     */
    public function newSystem()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'New System',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'message' => ''

        ];
        return view('BrainPages.newSystem')->with($data);
    }

    /**
     * Show the Template view.
     *
     */
    public function template()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'Templates',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

        ];
        return view('BrainPages.template')->with($data);
    }

}
