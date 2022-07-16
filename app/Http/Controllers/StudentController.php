<?php

namespace App\Http\Controllers;

use App\Model\Students;
use App\Student;
use App\Students as AppStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
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
        $stmt = Student::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>POB</th>
                        <th>DOB</th>
                        <th>Guardian</th>
                        <th>Sickness/Allergy</th>
                        <th>Phone Number</th>
                        <th>Family Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>
                            <img src="storage/images/'.$item->passport.'" width="50" class="img-thumbnail rounded-circle" />
                        </td>
                        <td> '.$item->fname.' '.$item->lname.' </td>
                        <td>'.$item->pob.'</td>
                        <td>'.$item->dob.'</td>
                        <td>'.$item->guardian.'</td>
                        <td>'.$item->sickness_allergy.'</td>
                        <td>'.$item->phone_no.'</td>
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

    // handle edit ajax

    public function edit(Request $request)
    {
        $id = $request->id;
        $stmt = Student::find($id);
        return response()->json($stmt);
    }

    // instant update 
    public function update(Request $request)
    {
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

    // delete data for Student
    public function delete(Request $request)
    {
        $id = $request->id;
        $stmt = Student::find($id);
        // return $stmt;
        if (Storage::delete('public/images/'.$stmt->passport)) {
            return Student::destroy($id);
        }
    }

}