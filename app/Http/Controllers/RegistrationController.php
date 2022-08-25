<?php

namespace App\Http\Controllers;

use App\Model\Students;
use App\Student;
use App\StudentData as StudentData;
use App\Students as AppStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('avatar');
        $fileName = time(). ".". $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $student_token = Hash::make('abcxyz');

        $student_data = [
            'name' => $request->input('fname'),
            // 'lname' => $request->input('lname'),
            'dob' => $request->input('dob'),
            'pob' => $request->input('pob'),
            'sickness_allergy' => $request->input('sickness'),
            'guardian' => $request->input('guard'),
            'address' => $request->input('address'),
            'phone_no' => $request->input('phone'),
            'name_of_school' => $request->input('school'),
            'Subject_learned' => $request->input('subject'),
            'email' => $request->input('email'),
            'ffname' => $request->input('ffname'),
            'passport' => $fileName,
            'token' => $student_token,
            'status' => 'Awaiting', 
            'date_admitted' => '',
            'class_admitted' => '',
            'current_class' => '',

        ];

        $stmt = StudentData::create($student_data);
        if ($stmt) {
            return response()->json([
                'status' => 200,
                'data' => $stmt
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };

        // print_r($student_data);
    }
}
