<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    //front page
    public function index()
    {
        $view_data['images'] = Gallery::all();
        return view('layouts.app_front', $view_data);
    }

    // online registration
    public function onlineRegView()
    {
        return view('front_page.online_registration');
    }
}
