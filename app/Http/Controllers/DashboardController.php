<?php

namespace App\Http\Controllers;

use App\Student as Student;

use App\StudentAdults as StudentAdults;

use App\StudentClass as StudentClass;

use App\Results as Results;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use LDAP\Result;
use phpDocumentor\Reflection\Types\Null_;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stmt_students = Student::all();
        $stmt_students_adult = StudentAdults::all();
        $view_data['total_students'] = $stmt_students->count();
        $view_data['total_student_adult'] = $stmt_students_adult->count();
        $view_data['loggedInData'] = $request->session()->all();
        return view('dashboard.index', $view_data);
    }


    // public function viewStudents(Request $request)
    // {
    //     $view_data['loggedInData'] = $request->session()->all();
    //     $student_data = Student::all();
    //     $view_data['student_list'] = $student_data;
    //     return view('students.all_students', $view_data);
    // }

    public function fetchStudents(Request $request)
    {
        return view('students.all_students');
    }

    public function fetchAllStudents()
    {
        return 'All Students';
    }

    public function newStudent(Request $request)
    {
        $view_data['loggedInData'] = $request->session()->all();
        return view('students.add_new_student', $view_data);
    }

    public function enrollStudent(Request $request)
    {

        $file = $request->file('avatar');
        $fileName = time(). ".". $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $student_token = '123456xyz';

        $student_data = [
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
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
            'token' => $student_token
        ];

        $stmt = Student::create($student_data);
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

    // public function addStudent(Request $request)
    // {

    //     $file = $request->file('avatar');
    //     $fileName = time(). ".". $file->getClientOriginalExtension();
    //     $file->storeAs('public/images', $fileName);

    //     $student_data = [
    //         'fname' => $request->input('fname'),
    //         'lname' => $request->input('lname'),
    //         'dob' => $request->input('dob'),
    //         'pob' => $request->input('pob'),
    //         'sickness_allergy' => $request->input('sickness'),
    //         'guardian' => $request->input('guard'),
    //         'address' => $request->input('address'),
    //         'phone_no' => $request->input('phone'),
    //         'name_of_school' => $request->input('school'),
    //         'Subject_learned' => $request->input('subject'),
    //         'email' => $request->input('email'),
    //         'ffname' => $request->input('ffname'),
    //         'passport' => $fileName,
    //     ];

    //     $stmt = Student::create($student_data);
    //     if ($stmt) {
    //         return response()->json([
    //             'status' => 200
    //         ]);
    //     }else{
    //         return response()->json([
    //             'status' => 300
    //         ]);
    //     };

    //     // print_r($student_data);
    // }

    public function editStudent($sid)
    {
        $view_data['edit_data'] = Student::where('id', $sid)->get();

        return view('students.edit_student', $view_data);
    }

    public function editInst(Request $request, $sid)
    {
        
        $student_data = [
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
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
        ];

        $stmt = Student::where('id', $sid)->update($student_data);
        
        if ($stmt) {
            return redirect()->route('dashboard-students')->with('status', 'updated');
        }else{
            return redirect()->route('dashboard-students')->with('status', 'not updated');
        }

    }

    public function deleteStudent($sid)
    {
        $view_data['delete_data'] = Student::where('id', $sid)->get();

        return view('students.delete_prompt', $view_data);
    }

    public function gradeStudents()
    {
        $view_data['student_list'] = Student::all();
        $view_data['classes'] = StudentClass::all();
        $view_data['header'] = 'Subjects';
        return view('dashboard.grade_students', $view_data);
    }

    public function gradeStudent(Request $request)
    {
        $student_data_grades = [
            'student_id' => $request->input('student_name'),
            'academic_session' => $request->input('academic_session'),
            'academic_term' => $request->input('academic_term'),
            'quran' => $request->input('quran'),
            'azkar' => $request->input('azkar'),
            'huruf' => $request->input('huruf'),
            'arabiyya' => $request->input('arabiyya'),
            'no_in_class' => $request->input('no_in_class'),
            'class_in' => $request->input('student_class'),
            'quran_grade' => $request->input('quran_grade'),
            'azkar_grade' => $request->input('azkar_grade'),
            'huruf_grade' => $request->input('huruf_grade'),
            'arabiyya_grade' => $request->input('arabiyya_grade'),
        ];

        $stmt = Results::create($student_data_grades);
        if ($stmt) {
            return response()->json([
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };
    }
}
