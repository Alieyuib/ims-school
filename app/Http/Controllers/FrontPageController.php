<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    //front page
    public function index()
    {
        return view('front_page.index');
    }

    // online registration
    public function onlineRegView()
    {
        return view('front_page.online_registration');
    }
}
