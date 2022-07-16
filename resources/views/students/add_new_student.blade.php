@extends('layouts.app')

@section('content')
    <div class="crumbs">
        <div class="col-md-12 breadcrumbs">
            <p class="breadcrumbs-text">Dashboard/New Student</p>
        </div>
    </div>
        {{-- add new student modal start --}}
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enroll New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="add_student_form" enctype="multipart/form-data" class="reg-form">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="firstname">Firstname</label>
                    <input type="hidden" class="form-control" name="status" id="status" value="1">
                    <input type="text" class="form-control" name="fname" placeholder="Firstname" id="firstname">
                </div>
                <div class="form-group col-md-4">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" name="lname" placeholder="Lastname" id="lastname">
                </div>
                <div class="form-group col-md-4">
                    <label for="familyname">Family Name</label>
                    <input type="text" class="form-control" name="ffname" placeholder="Family Name" id="familyname">
                </div>
                <div class="form-group col-md-4">
                    <label for="dob">DOB</label>
                    <input type="date" class="form-control" name="dob" placeholder="DOB" id="dob">
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
            <button type="submit" id="add_student_btn" class="btn btn-primary">Enroll</button>
        </div>
        </form>
    </div>
    </div>
</div>
{{-- add new employee modal end --}}
    <div class="form-div col-md-12">
       <div class="enroll-btn-div">
        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i
            class="bi-plus-circle me-2"></i>Enroll New Student</button>
       </div>
    </div>
    <script>
        // Adding New Employees
        $('#add_student_form').submit(function(e){
            e.preventDefault();
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            const fd = new FormData(this);
            if (
            $('#firstname').val() == '' ||            
            $('#lastname').val() == '' ||            
            $('#familyname').val() == '' ||            
            $('#pob').val() == '' ||            
            $('#dob').val() == '' ||            
            $('#sickness').val() == '' ||            
            $('#guard').val() == '' ||            
            $('#phone').val() == '' ||            
            $('#school').val() == '' ||            
            $('#subject').val() == '' ||            
            $('#email').val() == '' ||            
            $('#address').val() == ''  ||
            $('#avatar').val()          
            ) {
            Swal.fire(
                'All Form',
                'Input fields are require',
                'warning'
            )
        }else{

            $('#add_student_btn').text('Enrolling...');
            $.ajax({
                url: '{{ route('enroll.student') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    if (res.status == 200) {
                        Swal.fire(
                            'Student',
                            'Enrollment Sucessfully',
                            'success'
                        )
                        // fetchAllEmployees();
                        $('#add_student_form').trigger('reset');
                        $('#add_student_btn').text('Enroll');
                        $('#addStudentModal').modal('hide');
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Student',
                            'Enrollment Not Sucessfully',
                            'error'
                        )
                    } 
                }
            });
        }
            
        });
    </script>
@endsection