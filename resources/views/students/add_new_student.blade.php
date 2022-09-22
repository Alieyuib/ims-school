@extends('layouts.app')

@section('content')
<form action="#" method="POST" id="add_student_form" enctype="multipart/form-data" class="reg-form col-md-8">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
        </div>
    </div>
    @csrf
    <div class="">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="firstname">Fullname</label>
                <input type="hidden" class="form-control" name="status" id="status" value="1">
                <input type="text" class="form-control" name="fname" placeholder="Fullname" id="firstname">
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" name="lname" placeholder="Lastname" id="lastname">
            </div> --}}
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
        <button type="button" class="btn btn-ims-orange" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_student_btn" class="btn btn-ims-green">Enroll</button>
    </div>
    </form>
    <script>
        // Adding New student
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
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Student',
                            'Enrollment Sucessfully',
                            'success'
                        );
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