<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Student As Student;
use App\Books as Books;
use App\Results As Results;
use App\StudentClass as StudentClass;
use App\RegisteredCourses as RegisteredCourses;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use LDAP\Result;

class PortalController extends Controller
{
    //index(dashboard) 
    public function index()
    {
        return view('student_dashboard.index');
    }

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
            $student = Student::where('email', $request->email)->first();
            if ($student) {
                if ($request->token == $student->token) {
                    $request->session()->put('loggedInUser', $student->id);
                    $request->session()->put('loggedInName', $student->fname . ' ' . $student->lname);
                    $request->session()->put('loggedInEmail', $student->email);
                    $request->session()->put('loggedInAddress', $student->address);
                    $request->session()->put('loggedInFamilyName', $student->ffname);
                    $request->session()->put('loggedInGuardian', $student->guardian);
                    $request->session()->put('loggedInCreatedAt', $student->created_at);
                    $userLoggedIn = $request->session()->get('loggedInName');
                    $userLoggedInEmail = $request->session()->get('loggedInEmail');
                    $userLoggedInGuardian = $request->session()->get('loggedInGuardian');
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

    // dashboard view
    public function dashboard(Request $request)
    {
        $userLoggedId = $request->session()->get('loggedInUser');
        $member_count = Student::where('id', $userLoggedId)->get();
        $view_data['member_count'] = $member_count->count();
        return view('student_dashboard.dashboard', $view_data);
    }

    public function viewBioData(Request $request)
    {   
        $userLoggedId = $request->session()->get('loggedInUser');
        $student_bio = Student::where('id', $userLoggedId)->first();
        $view_data['student_id'] = $student_bio->id;
        $view_data['student_name'] = $student_bio->fname;
        return view('student_dashboard.student_bio_data', $view_data);
    }

    //result
    public function resultView(Request $request)
    {
        $view_data['loggedInName']  = $request->session()->get('loggedInName');
        return view('student_dashboard.results', $view_data);
    }

    public function viewResult(Request $request)
    {
        $userLoggedId = $request->session()->get('loggedInUser');
        $student_data = Student::where('id', $userLoggedId)->first();
        if ($student_data) {
            $result_data = Results::where('student_id', $userLoggedId)->first();
            $view_data['student_name'] = $student_data->fname . ' ' . $student_data->lname;
            $view_data['term'] = $result_data->academic_term;
            $view_data['session'] = $result_data->academic_session;
            $view_data['class'] = $result_data->class_in;
            $view_data['no_in_class'] = $result_data->no_in_class;


            $view_data['quran'] = $result_data->quran;
            $view_data['azkar'] = $result_data->azkar;
            $view_data['huruf'] = $result_data->huruf;
            $view_data['arabiyya'] = $result_data->arabiyya;

            $view_data['quran_grade'] = $result_data->quran_grade;
            $view_data['azkar_grade'] = $result_data->azkar_grade;
            $view_data['huruf_grade'] = $result_data->huruf_grade;
            $view_data['arabiyya_grade'] = $result_data->arabiyya_grade;


            $total_scores = $result_data->quran + $result_data->azkar + $result_data->huruf + $result_data->arabiyya;

            $total_average = $total_scores/4;

            $view_data['total_average'] = $total_average;
            $view_data['total_scores'] = $total_scores;






            return view('student_dashboard.result', $view_data);
        }else{
            $view_data['no_result'] = 'Res';
        }
        
    }

    // student result
    public function getResults(Request $request)
    {
        $userLoggedId = $request->session()->get('loggedInUser');
        $stmt = Results::where('student_id', $userLoggedId)->get();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Academic Session</th>
                        <th>Academic Term</th>
                        <th>Student Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->academic_session.'</td>
                        <td>'.$item->academic_term.' '. 'Term'.'</td>
                        <td>'.$item->class_in.' '. 'Class'.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 view-result text-ims-default text-decoration-none"><i class="bi-bookmark text-ims-default"></i>&nbspView Result</a>
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

    //getResultSingle

    public function getResultSingle(Request $request)
    {
        $id = $request->id;
        $stmt = Results::find($id);
        return response()->json($stmt);
    }

    // logout 
    public function logout()
    {
        Auth::logout();
        return redirect('student/portal');
    }

    // finance view
    public function financeView(Request $request)
    {
        $view_data['loggedInFamilyName']  = $request->session()->get('loggedInFamilyName');
        $view_data['loggedInName']  = $request->session()->get('loggedInName');
        return view('student_dashboard.finance', $view_data);
    }

    // print fee
    public function printFee(Request $request)
    {
        $loggedInFamilyName  = $request->session()->get('loggedInFamilyName');
        $stmt = Student::where('ffname', $loggedInFamilyName)->get();
        if ($stmt) {
            return response()->json($stmt);
        }else{
            return response()->json([
                'status' => 401,
            ]);
        }

    }

    // view receipt
    public function viewReceipt(Request $request)
    {
        $loggedInFamilyName  = $request->session()->get('loggedInUser');
        $student_data = Student::where('id', $loggedInFamilyName)->first();
        $view_data['student_name'] = $student_data->fname . ' ' .$student_data->lname;
        $view_data['student_address'] = $student_data->address;
        $view_data['receipt_date'] = date('D/M/Y');
        $view_data['receipt_no'] = Str::random(12);
        // return $view_data['student_payment_data'];
        return view('student_dashboard.receipt', $view_data);
    }

    // handle edit ajax

    public function getBioData(Request $request)
    {
        $id = $request->id;
        $stmt = Student::find($id);
        return response()->json($stmt);
    }

    // handle edit biodata
    public function updateBioData(Request $request)
    {
        // $student_id = $request->input('student_id');
        $fileName = '';
        $student_id = $request->input('student_id');
        $stmt = Student::find($request->student_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($stmt->avatar) {
                Storage::delete('public/images/' .$stmt->avatar);
            }
        }else {

            $fileName = $request->student_passport;
        }

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
        ];

            
            $final_stmt = Student::where('id', $student_id)->update($student_data);
            if ($final_stmt) {
                return response()->json([
                    'status' => 200
                ]);
            }else {
                return response()->json([
                    'status' => 300
                ]);
            }
    }

    public function courseRegistration(Request $request)
    {
        $userLoggedId = $request->session()->get('loggedInUser');
        $stmt = Student::find($userLoggedId);
        $view_data['student_name'] = $stmt->fname;
        $view_data['student_id'] = $stmt->id;
        $view_data['classes'] = StudentClass::all();
        return view('student_dashboard.course_registration', $view_data);
    }

    public function coursesRegistration(Request $request)
    {
        $student_course_data = [
            'student_name' => $request->input('student_name'),
            'student_id' => $request->input('student_id'),
            'student_class' => $request->input('student_class'),
            'academic_session' => $request->input('academic_session'),
            'academic_term' => $request->input('academic_term'),
            'sub_one' => $request->input('al_quran'),
            'sub_two' => $request->input('al_azkar'),
            'sub_three' => $request->input('al_huruf'),
            'sub_four' => $request->input('al_arabiyya'),
            'sub_one_scores' => 0,
            'sub_two_scores' => 0,
            'sub_three_scores' => 0,
            'sub_four_scores' => 0,
        ];

        $course_registration = RegisteredCourses::create($student_course_data);

        if ($course_registration) {
            return response()->json([
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        }
    }

    public function getBooks(Request $request)
    {
        return view('student_dashboard.books');
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
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td> <a href="../../storage/books/'.$item->book_file.'">'.$item->book_name.'</a> </td>
                            <td>'.$item->created_at.'</td>  
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
