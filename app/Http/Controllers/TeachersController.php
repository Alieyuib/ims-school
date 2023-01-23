<?php

namespace App\Http\Controllers;

use App\Teachers as Teachers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Student As Student;
use App\Results As Results;
// use App\StudentCourses as StudentCourses;
use App\systemUsers as SystemUsers;
use App\RegisteredCourses as RegisteredCourses;
use App\StudentData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use LDAP\Result;

// use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index()
    {
        return view('teachers.index');
    }

    // public function makeToken()
    // {
    //     $token = Hash::make('123456xyz');
    //     $email = 'Teacher@test4.com';
    //     $teaching_subject = 'al-arabiya';
    //     $fname = 'Teacher Test';

    //     $teacher_data = [
    //         'fname' => $fname,
    //         'email' => $email,
    //         'teaching_subject' => $teaching_subject,
    //         'token' => $token
    //     ];

    //     Teachers::create($teacher_data);
    // }

    // portal login
    public function portalLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'token' => 'required|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg'   => $validator->getMessageBag()
            ]);
        }else{
            $user = Teachers::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->token, $user->token)) {
                    $request->session()->put('loggedInUser', $user->id);
                    $request->session()->put('loggedInTeacher', $user->fname);
                    $request->session()->put('loggedInEmail', $user->email);
                    $request->session()->put('loggedInSubject', $user->teaching_subject);
                    $userLoggedIn = $request->session()->get('loggedInTeacher');
                    return response()->json([
                        'status' => 200,
                        'msg'    => 'success',
                        'msg2'   => 'LoggedIN As'.' '.$userLoggedIn,
                    ]);
                }else{

                    return response()->json([
                        'status' => 401,
                        'msg'    => 'Email or password is incorrect',
                        'icon' =>   'warning'
                    ]);
                }
                
            }else{
                return response()->json([
                    'status'  => 401,
                    'msg' => 'User not found!',
                    'icon' =>   'warning'
                ]);
            }
        }
    }

    public function dashboardView(Request $request)
    {
        $view_data['loggedInTeacher'] = $request->session()->get('loggedInTeacher');
        $view_data['loggedInSubject'] = $request->session()->get('loggedInSubject');
        return view('teachers.dashboard', $view_data);
    }
    public function gradeView(Request $request)
    {
        $view_data['loggedInTeacher'] = $request->session()->get('loggedInTeacher');
        $view_data['loggedInSubject'] = $request->session()->get('loggedInSubject');
        return view('teachers.grade_student', $view_data);
    }

    public function filterCourseByClass(Request $request)
    {
        $class = $request->get('class_name');
        $stmt = RegisteredCourses::where('student_class', $class)->get();
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
                            <th>Subject Scores</th>
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
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>GRADE</a>
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

    public function fetchAllStudentCourse(Request $request)
    {
        $loggedInSubject = $request->session()->get('loggedInSubject');
        if ($loggedInSubject == 'al-quran') {
            $stmt = RegisteredCourses::where('sub_one', $loggedInSubject)->get();
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
                            <th>Subject Scores</th>
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
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>GRADE</a>
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

        if ($loggedInSubject == 'al-azkar') {
            $stmt = RegisteredCourses::where('sub_two', $loggedInSubject)->get();
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
                            <th>Subject Scores</th>
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
                            <td>'.$item->sub_two_scores.'</td>  
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>GRADE</a>
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

        if ($loggedInSubject == 'al-huruf') {
            $stmt = RegisteredCourses::where('sub_three', $loggedInSubject)->get();
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
                            <th>Subject Scores</th>
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
                            <td>'.$item->sub_three_scores.'</td>  
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>GRADE</a>
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

        if ($loggedInSubject == 'al-arabiyya') {
            $stmt = RegisteredCourses::where('sub_four', $loggedInSubject)->get();
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
                            <th>Subject Scores</th>
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
                            <td>'.$item->sub_four_scores.'</td>  
                            <td>
                                <a href="#" id="'.$item->id.'" class="mx-2 gradeIcon" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"><i class="fa fa-bookmark text-secondary"></i>GRADE</a>
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

        // $loggedInSubject = $request->session()->get('loggedInSubject');
        if ($loggedInSubject == 'Faslul Hifiz') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Arrauda Ath-thaaniya') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Arraudatul Ola') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Hadaanah') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Class 1') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Class 2') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Class 3') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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

        if ($loggedInSubject == 'Class 4') {
            $stmt = StudentData::where('current_class', $loggedInSubject)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Dob</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Sickness/Allergy</th>
                            <th>Student Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> '.$item->name.'</td>
                            <td> '.$item->dob.'</td>
                            <td> '.$item->address.'</td>
                            <td> '.$item->phone_no.'</td>
                            <td> '.$item->sickness_allergy.'</td>
                            <td>'.$item->current_class.'</td> 
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
        
    }


    public function getSubjectData(Request $request)
    {
        $id = $request->id;
        $loggedInSubject = $request->session()->get('loggedInSubject');
        $stmt = RegisteredCourses::find($id);
        return response()->json([
            'data' => $stmt,
            'subject_data' => $loggedInSubject
        ]);
    }

    public function updateScores(Request $request)
    {
        $loggedInSubject = $request->session()->get('loggedInSubject');
        $subject_id = $request->input('subject_id');
        if ($loggedInSubject == 'al-quran') {
            $scores_data = [
                'sub_one_scores' => $request->input('subject_marks'),
            ];

            $stmt = RegisteredCourses::where('id', $subject_id)->update($scores_data);

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

        if ($loggedInSubject == 'al-azkar') {
            $scores_data = [
                'sub_two_scores' => $request->input('subject_marks'),
            ];

            $stmt = RegisteredCourses::where('id', $subject_id)->update($scores_data);

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

        if ($loggedInSubject == 'al-huruf') {
            $scores_data = [
                'sub_three_scores' => $request->input('subject_marks'),
            ];

            $stmt = RegisteredCourses::where('id', $subject_id)->update($scores_data);

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

        if ($loggedInSubject == 'al-arabiyya') {
            $scores_data = [
                'sub_four_scores' => $request->input('subject_marks'),
            ];

            $stmt = RegisteredCourses::where('id', $subject_id)->update($scores_data);

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

    public function getResults(Request $request)
    {
        return 'middleware';
    }

    // logout 
    public function logout()
    {
        Auth::logout();
        return redirect('teacher/portal');
    }
}
