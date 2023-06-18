<?php

namespace App\Http\Controllers;

use App\Model\Students;
use App\Student;
use App\StudentData as StudentData;
use App\Students as AppStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function studentData()
    {
        return StudentData::all();
    }
    public function index()
    {
        return view('students.all_students');
    }

    public function store(Request $request)
    {
        $student_data = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'pob' => $request->pob,
            'sickness_allergy' => $request->allergy,
            'guardian' => $request->guardian,
            'address' => $request->address,
            'phone_no' => $request->phone,
            'name_of_school' => $request->school_name,
            'Subject_learned' => $request->subject_learn,
            'email' => $request->email,
        ];

        print_r($student_data);

        // $stmt = 

        // if ($stmt) {
        //     return response()->json([
        //         'status' => 200
        //     ]);
        // }else{
        //     return response()->json([
        //         'status' => 300
        //     ]);
        // }
}


public function fetchAll()
    {
        $stmt = StudentData::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-hover">
                <thead class="text-ims-default">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Sickness/Allergy</th>
                        <th>Family Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td> '.$item->name.' </td>
                        <td>'.$item->dob.'</td>
                        <td>'.$item->sickness_allergy.'</td>
                        <td>'.$item->ffname.'</td>
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

    public function filter_by_class(Request $request)
    {
        $class = $request->get('class_name');
        $stmt = StudentData::where('current_class', $class)->get();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-hover">
                <thead class="text-ims-default">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Sickness/Allergy</th>
                        <th>Family Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td> '.$item->name.' </td>
                        <td>'.$item->dob.'</td>
                        <td>'.$item->sickness_allergy.'</td>
                        <td>'.$item->ffname.'</td>
                        <td class="text-uppercase">'.$item->active.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 editIcon" data-bs-toggle="modal" data-bs-target="#editStudentModal"><i class="bi-pencil-square text-secondary"></i></a>
                            <a href="#" id="'.$item->id.'" class="mx-2 deleteIcon"><i class="bi-trash text-danger"></i></a>
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
    // handle edit ajax

    public function edit(Request $request)
    {
        $id = $request->id;
        $stmt = StudentData::find($id);
        return response()->json($stmt);
    }

    // instant update 
    public function update(Request $request)
    {
        // $active = null;
        // if ($request->input('active') == 0) {
        //     $active = true;
        // };
        // if ($request->input('active') == 1) {
        //     $active = false;
        // };
        $fileName = '';
        $student_id = $request->input('student_id');
        $stmt = StudentData::find($request->student_id);
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
            'name' => $request->input('fname'),
            // 'lname' => $request->input('lname'),
            'dob' => $request->input('dob'),
            'pob' => $request->input('pob'),
            'sickness_allergy' => $request->input('sickness'),
            // 'guardian' => $request->input('guard'),
            'address' => $request->input('address'),
            'phone_no' => $request->input('phone'),
            'name_of_school' => $request->input('school'),
            'Subject_learned' => $request->input('subject'),
            'email' => $request->input('email'),
            'ffname' => $request->input('ffname'),
            'current_class' => $request->input('current_class'),
            'active' => $request->input('stat'),
            'passport' => $fileName,
        ];

            
            $final_stmt = StudentData::where('id', $student_id)->update($student_data);
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

    // delete data for Student
    public function delete(Request $request)
    {
        $id = $request->id;
        $stmt = StudentData::find($id);
        // return $stmt;
        Storage::delete('public/images/'.$stmt->passport);
        return StudentData::destroy($id);
    }

    public function classOneStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Class 1')->get();
        return view('dashboard.classes.class_one', $view_data);
    }

    public function classTwoStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Class 2')->get();
        return view('dashboard.classes.class_two', $view_data);
    }

    public function classThreeStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Class 3')->get();
        return view('dashboard.classes.class_three', $view_data);
    }

    public function classFourStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Class 4')->get();
        return view('dashboard.classes.class_four', $view_data);
    }

    public function classHadaanahStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Hadaanah')->get();
        return view('dashboard.classes.class_hadaana', $view_data);
    }

    public function classHifizStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Faslul Hifiz')->get();
        return view('dashboard.classes.class_hifiz', $view_data);
    }

    public function classThaaniyaStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Arrauda Ath-thaaniya')->get();
        return view('dashboard.classes.class_arrauda_ol', $view_data);
    }

    public function classOlaStudents(StudentData $student)
    {
        $view_data['students'] = $student->where('current_class', 'Arraudatul Oola')->get();
        return view('dashboard.classes.class_arrauda_tha', $view_data);
    }

}