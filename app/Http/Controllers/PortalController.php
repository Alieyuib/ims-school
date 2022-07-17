<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Student As Student;
use App\Results As Results;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            // 'password' => 'required|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg'   => $validator->getMessageBag()
            ]);
        }else{
            $student = Student::where('email', $request->email)->first();
            if ($student) {
                $request->session()->put('loggedInUser', $student->id);
                $request->session()->put('loggedInName', $student->fname . ' ' . $student->lname);
                $request->session()->put('loggedInEmail', $student->email);
                $request->session()->put('loggedInFamilyName', $student->ffname);
                $request->session()->put('loggedInCreatedAt', $student->created_at);
                $userLoggedIn = $request->session()->get('loggedInName');
                return response()->json([
                    'status' => 200,
                    'msg'    => 'success',
                    'msg2'   => 'LoggedIN As'.' '.$userLoggedIn,
                   ]);
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
        return view('student_dashboard.dashboard');
    }

    public function viewBioData()
    {
        return view('student_dashboard.student_bio_data');
    }

    //result
    public function resultView(Request $request)
    {
        $view_data['loggedInName']  = $request->session()->get('loggedInName');
        return view('student_dashboard.results', $view_data);
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
                            <a href="#" id="'.$item->id.'" class="mx-2 view-result text-success text-decoration-none" data-bs-toggle="modal" data-bs-target="#resultModal"><i class="bi-bookmark text-success"></i>&nbspView Result</a>
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
        $loggedInFamilyName  = $request->session()->get('loggedInFamilyName');
        $view_data['student_payment_data'] = Student::where('ffname', $loggedInFamilyName)->get();
        // return $view_data['student_payment_data'];
        return view('student_dashboard.receipt', $view_data);
    }
}
