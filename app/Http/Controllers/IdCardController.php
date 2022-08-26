<?php

namespace App\Http\Controllers;

use App\StudentData;
use Illuminate\Http\Request;

class IdCardController extends Controller
{
    //

    public function index()
    {
        $stmt = StudentData::all();
        $view_data['students'] = $stmt;
        return view('dashboard.generate_idcard', $view_data);
    }

    public function generateIdCard(Request $request, $id)
    {
        $stmt = StudentData::find($id);
        $view_data['student_name'] = $stmt->name;
        $view_data['passport'] = $stmt->passport;

        return view('template.idcard', $view_data);
    }
}
