<?php

namespace App\Http\Controllers;

use App\Student as Student;

use App\StudentAdults as StudentAdults;

use App\RegisteredCourses as RegisteredCourses;

use App\Books as Books;

use App\StudentClass as StudentClass;
use App\Finance as Finance;

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

    public function gradeInfo(Request $request)
    {

        $id = $request->id;
        $session_ = $request->session_;
        $term = $request->term;

        $grade_info_data = [
            'student_id' => $request->id,
            'academic_session' => $request->session_,
            'academic_term' => $request->term
        ];

        $stmt = RegisteredCourses::where('academic_session', $session_)->get();

        return response()->json($stmt);
    }

    public function subjectRecord()
    {
        return view('dashboard.subject_records');
    }

    public function subjectRecords()
    {
        $stmt = RegisteredCourses::all();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Student Class</th>
                            <th>Academic Term</th>
                            <th>Academic Session</th>
                            <th>Al-Quran Scores</th>
                            <th>Al-Azkar Scores</th>
                            <th>Al-Huruf Scores</th>
                            <th>Al-Arabiya Scores</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->student_name.'</td>
                            <td>'.$item->student_class.'</td>
                            <td>'.$item->academic_term.' Term</td>
                            <td>'.$item->academic_session.'</td>  
                            <td>'.$item->sub_one_scores.'</td>  
                            <td>'.$item->sub_two_scores.'</td>  
                            <td>'.$item->sub_three_scores.'</td>  
                            <td>'.$item->sub_four_scores.'</td>  
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon text-decoration-none" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>Make Result</a>
                            </td>
                        </tr>';
                    }

                    $output .= '</tbody></table>';
                    echo $output;
            }else{
                echo '<h1 class="text-center text-secondary my-5">
                    No records present in the database
                </h1>';
            }
    }

    public function getBooks(Request $request)
    {
        return view('dashboard.books');
    }

    public function loadBook()
    {
        $stmt = Books::all();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Uploaded On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> <a href="../storage/books/'.$item->book_file.'">'.$item->book_name.'</a> </td>
                            <td>'.$item->created_at.'</td>  
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 editIcon" data-bs-toggle="modal" data-bs-target="#editStudentModal"><i class="bi-pencil-square text-secondary"></i></a>
                                <a href="#" id="'.$item->id.'" class="mx-2 deleteIcon"><i class="bi-trash text-warning"></i></a>
                            </td>
                        </tr>';
                    }

                    $output .= '</tbody></table>';
                    echo $output;
            }else{
                echo '<h1 class="text-center text-secondary my-5">
                    No records present in the database
                </h1>';
            }
    }

    public function uploadBook(Request $request)
    {
        $file = $request->file('book_file');
        $fileName = time(). ".". $file->getClientOriginalExtension();
        $file->storeAs('public/books', $fileName);

        $book_name = $request->input('book_name');

        $book_data = [
            'book_name' => $book_name,
            'book_file' => $fileName
        ];

        $stmt = Books::create($book_data);

        if ($stmt) {
            return response()->json([
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 400
            ]);
        }
    }
}
