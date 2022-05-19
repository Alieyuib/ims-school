<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $view_data['heading'] = 'IMS SCHOOL';
        return view('main', $view_data);
    }

    public function registration()
    {
        $view_data = [];
        return view('registration', $view_data);
    }
}
