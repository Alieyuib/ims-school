<?php

namespace App\Http\Controllers;

use App\Student as Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\StudentAdults as StudentAdults;
use App\systemUsers as SystemUsers;
use App\StudentData as StudentData;

use App\RegisteredCourses as RegisteredCourses;

use App\Books as Books;

use App\SchoolClasses as SchoolClasses;

use App\Finance as Finance;
use App\Items;
use App\Mail\InvoiceSend;
use App\Results as Results;
use App\StudentFamilyAccount;
use App\User;
use App\AccessibleEntities;
use App\Gallery;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;
use LDAP\Result;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stmt_students = StudentData::all();
        $stmt_users = SystemUsers::all();
        $stmt_account = StudentFamilyAccount::all();
        // $stmt_students_adult = StudentAdults::all();
        $view_data['total_students'] = $stmt_students->count();
        $view_data['total_users'] = $stmt_users->count();
        $view_data['total_account'] = $stmt_account->count();
        // $view_data['total_student_adult'] = $stmt_students_adult->count();
        $view_data['loggedInData'] = $request->session()->all();
        $view_data['userLoggedIn'] = $request->session()->get('loggedInName');
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
        $view_data['classes'] = SchoolClasses::all();
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
                $output .= '<table class="table table-bordered table-hover">
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
                                <a href="#" id="'.$item->id.'" class="btn btn-ims-orange mx-2 gradeIcon text-decoration-none" data-bs-toggle="modal" data-bs-target="#gradeStudentModal"></i>Send Result</a>
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
                $output .= '<table class="table table-bordered table-hover">
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

    public function getAwaitStudents(Request $request)
    {
        $view_data['classes'] = SchoolClasses::all();
        return view('dashboard.enrollment', $view_data);
    }

    public function getAwaitingStudents()
    {  
        $stmt = StudentData::where('status', 'Awaiting')->get();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Family Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>
                            <img src="../storage/images/'.$item->passport.'" width="50" class="img-thumbnail rounded-circle" />
                        </td>
                        <td> '.$item->name.' </td>
                        <td>'.$item->email.'</td>
                        <td>'.$item->phone_no.'</td>
                        <td>'.$item->ffname.'</td>
                        <td>'.$item->status.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 editIcon btn btn-ims-green" data-bs-toggle="modal" data-bs-target="#editStudentModal">Enroll Student</a>
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

    public function getStudentAwaitData(Request $request)
    {
        $id = $request->id;
        $stmt = StudentData::find($id);
        return response()->json($stmt);
    }

    public function enrollAwaitingStudent(Request $request)
    {
        // $student_id = $request->input('student_id');
        // $view_data['password'] = Hash::make('abcxyz');
        $fileName = '';
        $student_id = $request->input('student_id');
        $stmt = StudentData::find($request->student_id);
        $password = 'abcxyz';
        $email_to_send = $stmt->email;
        $to_who = $stmt->name;
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
        
        $current_class = $request->input('class_admitted');

        $student_data = [
            'token' => Hash::make('abcxyz'),
            'status' => 'Enrolled', 
            'date_admitted' => date('D/M/Y'),
            'class_admitted' => $current_class,
            'current_class' => $current_class,
        ];
            
        $final_stmt = StudentData::where('id', $student_id)->update($student_data);
        if ($final_stmt) {
            Mail::to($email_to_send)->send(new InvoiceSend($password, $email_to_send, $to_who));
            return response()->json([
                'status' => 200
            ]);
        }else {
            return response()->json([
                'status' => 300
            ]);
        }
    }

    public function allUsers(Request $request)
    {
        $view_data['users_list'] = User::all();
        return view('dashboard.user_management', $view_data);
    }

    public function newUser(Request $request)
    {
        return view('dashboard.new_user');
    }

    public function createUser(Request $request)
    {
        $user_data = [
            'name' => $request->input('fname'),
            'email' => $request->input('email'),
            'password' => Hash::make('abcxyz'),
        ];

        $password = 'abcxyz';
        $email_to_send = $request->input('email');
        $to_who = $request->input('fname');

        $stmt = User::create($user_data);
        if ($stmt) {
            Mail::to($email_to_send)->send(new InvoiceSend($password, $email_to_send, $to_who));
            return response()->json([
                'status' => 200,
                'data' => $stmt
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };
    }

    public function viewAllUser()
    {
        $stmt = User::all();
        $output = '';
        foreach ($stmt as $user) {
            foreach ($user->getRoleNames() as $role_name) {
                $role__name = $role_name;
            }
        }
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'</td>
                        <td>'.$item->email.'</td>
                        <td>'.$role__name.'</td>
                        <td>
                            <a href="/dashboard/user/edit/'.$item->id.'" id="'.$item->id.'" class="mx-2 btn btn-ims-orange">Edit</a>
                            <a href="/dashboard/user/delete/'.$item->id.'" id="'.$item->id.'" class="mx-2 btn btn-danger">Delete</a>
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

    public function getEditUser(Request $request, $uid)
    {
        $user = User::find($uid);
        $view_data['uid'] = $user->id;
        $view_data['name'] = $user->name;
        $view_data['email'] = $user->email;
        $view_data['password'] = $user->password;
        return view('dashboard.edit_user', $view_data);
    }


    public function editUser(Request $request, $uid)
    {
        $user = User::find($uid);
        if ($request->isMethod('post')) {
            $request->validate([
                'fname' => 'string|max:250|required',
            ]);
            if($request->input('email') != $user->email){
                $request->validate(['email'=> 'unique:users,email|required|email|max:250']);
            }
    
            $user->name = $request->input('fname');
            $user->email = $request->input('email');
            
            if ( $request->filled('password') ) {
                $user->password = Hash::make($request->input('password'));
            }

            if($user->save()){
                $request->session()->flash('status', 'User Updated!');
                return redirect('/dashboard/users');
            }
        }

        $view_data['uid'] = $user->id;
        $view_data['name'] = $user->name;
        $view_data['email'] = $user->email;
        $view_data['password'] = $user->password;
        return view('dashboard.edit_user', $view_data);


    }

    public function deleteUser(Request $request, $uid)
    {
        $deleted = User::where('id', $uid)->delete();

        if ($deleted) {
            $request->session()->flash('status', 'User deleted!');
            return redirect('dashboard/users');
        }else{
            $request->session()->flash('status', 'User not deleted!');
            return redirect('dashboard/users');
        }
    }

    public function editUserAccess(Request $request, $uid)
    {
        $user = User::find($uid);
        // $view_data['user'] = User::find($uid);
        $view_data['user'] = $user;
        $view_data['uid'] = $user->id;
        $view_data['name'] = $user->name;
        $view_data['roles_list'] = Role::all();
        $view_data['classes'] = SchoolClasses::all();
        return view('dashboard.edit_user_access',$view_data);
    }

    public function assignUserRole(Request $request, $uid)
    {
        $user = User::find($uid);
        if ($request->isMethod('post')) {
            
            $request->validate([
                'user' => 'exists:App\User,id'
                //todo
                //check and validate roles before assigning
            ]);

            

            if( $user->syncRoles($request->input('roles')) ){
                $request->session()->flash('status', 'Role Assign!');
            }
            else{
                $request->session()->flash('status', 'There was an error assiging roles some ar all may not have been assigned');
            }

            $view_data['user'] = $user;
            $view_data['uid'] = $user->id;
            $view_data['name'] = $user->name;
            $view_data['roles_list'] = Role::all();
            $view_data['classes'] = SchoolClasses::all();
            return view('dashboard.edit_user_access',$view_data);
        
        }

        return redirect('/dashboard/user/edit-user-access/'.$user->id);
    }

    public function assignUserAccesibleEntities(User $user, Request $request)
    {
        // $user = User::find($uid);
        // $view_data['user'] = User::find($uid);
        $view_data['user'] = $user;
        $view_data['uid'] = $user->id;
        $view_data['name'] = $user->name;
        $view_data['roles_list'] = Role::all();
        $view_data['classes'] = SchoolClasses::all();

        if ($request->isMethod('post')) {

            $request->validate([
                'user' => 'exists:App\User,id'
                //todo
                //check and validate roles before assigning
            ]);
            $user_accessible_entities = $user->accessibleEntities();
            
            $user_accessible_entities->school_classes = $request->input('school_classes','[]');
            // $user_accessible_entities->locations = $request->input('locations');

            if ($user_accessible_entities->save()) {
                $request->session()->flash('status', 'Role Assign!');
            }else{
                $request->session()->flash('status', 'There was an error assiging roles some ar all may not have been assigned');
            }

            return view('dashboard.edit_user_access',$view_data);
        }
    }

    public function getUserData(Request $request)
    {
        $id = $request->id;
        $stmt = SystemUsers::find($id);
        return response()->json($stmt);
    }

    public function userDataUpdate(Request $request)
    {
        $user_id = $request->input('user_id');

        $role = $request->input('role');

        $user_data = [
            'role' => $role
        ];
            
        $final_stmt = SystemUsers::where('id', $user_id)->update($user_data);

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

    public function newItem()
    {
        return view('dashboard.new_item');
    }

    public function addNewItem(Request $request)
    {
        $item_data = [
            'item_name' => $request->input('item_name'),
            'item_price' => $request->input('item_price'),
            'type' => $request->input('item_type'),
        ];

        $stmt = Items::create($item_data);
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
    }

    public function viewAllItem()
    {
        return view('dashboard.items');
    }

    public function getItems()
    {
        $stmt = Items::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->item_name.'</td>
                        <td>&#8358;'.$item->item_price.'</td>
                        <td>'.$item->type.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="bi-pencil-square text-secondary"></i></a>
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

    public function getItem(Request $request)
    {
        $id = $request->id;
        $stmt = Items::find($id);
        return response()->json($stmt);
    }

    public function updateItem(Request $request)
    {
        $item_id = $request->input('item_id');
        // $item_name = $request->input('item_name');
        // $item_price = $request->input('item_price');

        $item_data = [
            'item_name' => $request->input('item_name'),
            'item_price' => $request->input('item_price'),
            'type' => $request->input('item_type'),
        ];
            
        $final_stmt = Items::where('id', $item_id)->update($item_data);

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

    public function deleteItem(Request $request)
    {
        $id = $request->id;
        $stmt = Items::find($id);
        // return $stmt;
        return Items::destroy($id);
    }

    public function addPictures(Request $request)
    {
        return view('dashboard.add_picture');
    }

    public function addPicture(Request $request)
    {
        $file = $request->file('upld_img');
        $fileName = time(). ".". $file->getClientOriginalExtension();
        $file->storeAs('public/gallery', $fileName);

        $caption_img = $request->input('img_caption');

        $book_data = [
            'caption_img' => $caption_img,
            'img_file' => $fileName
        ];

        $stmt = Gallery::create($book_data);

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

    public function deletePictures(Request $request)
    {
        $view_data['images'] = Gallery::all();

        // $images = $view_data['images'];

        return view('dashboard.delete_pictures', $view_data);
    }

    public function deletePicture(Request $request, $id)
    {
        $stmt = Gallery::destroy($id);

        if ($stmt) {
            $request->session()->flash('status', 'Image Deleted!');
        }else{
            $request->session()->flash('status', 'Image not Deleted!');
        }

        return redirect(route('dashboard.delete.pictures'));
    }

    
}
