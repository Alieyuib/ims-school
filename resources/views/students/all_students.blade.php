
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application With Image Upload Using Laravel 7 and Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style type="text/css" rel="stylesheet">
        table tr td img.img-thumbnail{
          width: 70px;
          height: 70px;
        }
        table tr th{
          color: #0d6efd!important;
          /* font-weight: lighter !important; */
          /* font-style: oblique; */
        }
    </style>

</head> --}}
@extends('layouts.app')

@section('content')
{{-- <body class="bg-dark"> --}}
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Enroll Student Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="edit_student_form" enctype="multipart/form-data" class="reg-modal-form">
        @csrf
        <input type="hidden" name="student_id" id="student_id">
        <input type="hidden" name="student_passport" id="student_passport">
        <div class="modal-body p-4 bg-light">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="firstname">Fullname</label>
                    {{-- <input type="hidden" class="form-control" name="status" id="status" value="1"> --}}
                    <input type="text" class="form-control" name="fname" placeholder="Firstname" id="firstname">
                </div>
                <div class="form-group col-md-4">
                    <label for="familyname">Family Name</label>
                    <input type="text" class="form-control" name="ffname" placeholder="Family Name" id="familyname">
                </div>
                <div class="form-group col-md-4">
                    <label for="dob">DOB</label>
                    <input type="text" class="form-control" name="dob" placeholder="DOB" id="dob">
                </div>
                <div class="form-group col-md-4">
                    <label for="pob">POB</label>
                    <input type="text" class="form-control" name="pob" placeholder="Place of Birth" id="pob">
                </div>
                <div class="form-group col-md-4">
                    <label for="sickness">Sickness/Allergy</label>
                    <input type="text" class="form-control" name="sickness" placeholder="Sickness/Allergy" id="sickness">
                </div>
                <div class="form-group col-md-4">
                    <label for="guard">Guardian/Husband</label>
                    <input type="text" class="form-control" name="guard" placeholder="Guardian/Husband" id="guard">
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" id="phone">
                </div>
                <div class="form-group col-md-4">
                    <label for="school">Name of School</label>
                    <input type="text" class="form-control" name="school" placeholder="Name of School" id="school">
                </div>
                <div class="form-group col-md-4">
                    <label for="subject">Subject Learned</label>
                    <input type="text" class="form-control" name="subject" placeholder="Subject Learned" id="subject">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" id="email">
                </div>
                <div class="form-group col-md-4">
                    <label for="passport">Passport</label>
                    <input type="file" name="avatar" class="form-control" id="passport">
                </div>
                <div class="mt-2" id="passport-div">

                </div>
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" id="address">
                </div>
                {{-- <div class="form-group col-md-12">
                    <button class="btn btn-success" type="submit" id="save-btn">Save <i class="fa fa-save"></i></button>
                </div> --}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="edit_student_btn" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
    </div>
</div>
{{-- edit student modal end --}}
  <div class="container">
    <div class="row my-1">
      <div class="col-lg-12 student-list-div">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">All Enroll Students (تسجيل جميع الطلاب)</h3>
          </div>
          <div class="card-body bg-orange" id="show_all_students">
            <h1 class="text-center text-secondary my-5">
                <img src="{{asset('images/Hourglass.gif')}}" alt="" srcset="">
            </h1>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fetch All Employee
        setTimeout(() => {
            fetchAllStudents();
        },2500);
        function fetchAllStudents() {
            $.ajax({
                url: '{{ route('fetchAll') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'asc'],
                    });
                }
            })
        }

        // update employee ajax 
        $('#edit_student_form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#edit_student_btn').text('Saving....');
            $.ajax({
                url: '{{ route('update') }}',
                method: 'post',
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Student',
                            'Data Updated Successfully',
                            'success'
                        );
                        $('#edit_student_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#edit_student_btn').text('Save');
                        fetchAllStudents();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Student',
                            'Data Not Updated',
                            'error'
                        );
                        $('#edit_student_btn').text('Save');
                    } 
                }
            })
        })

        // edit employee data ajax
        $(document).on('click', '.editIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('edit') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    $('#firstname').val(res.name);
                    $('#student_id').val(res.id);
                    $('#student_passport').val(res.passport);
                    // $('#lastname').val(res.lname);
                    $('#familyname').val(res.ffname);
                    $('#email').val(res.email);
                    $('#pob').val(res.pob);
                    $('#dob').val(res.dob);
                    $('#guard').val(res.guardian);
                    $('#phone').val(res.phone_no);
                    $('#school').val(res.name_of_school);
                    $('#subject').val(res.Subject_learned);
                    $('#passport-div').html(`<img src="../../storage/images/${res.passport}" class="img-thumbnail">`)
                    $('#address').val(res.address);
                    $('#sickness').val(res.sickness_allergy);
                }
            })

        })



        // delete student data 
        $(document).on('click', '.deleteIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('delete') }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res){
                       console.log(res);
                       Swal.fire(
                           'Deleted',
                           'Employee Data',
                           'success'
                       )  
                       fetchAllStudents();
                    }
                })
            }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

