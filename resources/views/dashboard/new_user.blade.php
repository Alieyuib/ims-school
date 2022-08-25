@extends('layouts.app')

@section('content')

<form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-ims-default">Create new user</h6>
        </div>
    </div>
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label for="fname">Fullname</label>
            <input type="text" class="form-control" name="fname" placeholder="Fullname" id="fname">
        </div>
        <div class="form-group col-md-12">
            <label for="phone_no">Phone Number</label>
            <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" id="phone_no">
        </div>
        <div class="form-group col-md-12">
            <label for="email">Email <Address></Address></label>
            <input type="text" class="form-control" name="email" placeholder="Email Address" id="email">
        </div>
        {{-- <div class="form-group col-md-12">
            <label for="pword">Password</label>
            <input type="password" class="form-control" name="pword" placeholder="Password" id="pword">
        </div> --}}
        {{-- <div class="form-group col-md-12">
            <label for="cpword">Confirm Password</label>
            <input type="text" class="form-control" name="cpword" placeholder="Confirm Password" id="cpword">
        </div> --}}
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Create <i class="fa fa-bookmark-o"></i></button>
        </div>
    </div>
</form>
<script>
    // Grade Student
    // $("#student_name").val() == 'SELECT STUDENT';
    // Array.range = function(a, b, step){
    //     var A = [];
    //     if(typeof a == 'number'){
    //         A[0] = a;
    //         step = step || 1;
    //         while(a+step <= b){
    //             A[A.length]= a+= step;
    //         }
    //     }
    //     else {
    //         var s = 'abcdefghijklmnopqrstuvwxyz';
    //         if(a === a.toUpperCase()){
    //             b = b.toUpperCase();
    //             s = s.toUpperCase();
    //         }
    //         s = s.substring(s.indexOf(a), s.indexOf(b)+ 1);
    //         A = s.split('');        
    //     }
    //     return A;
    // }
    // $('#quran').on('change', function(){
    //     if ($('#quran').val() == Array.range(79,100)) {
    //         $('#quran').addClass("text-success");
    //     }
    // })
    $('#grade_student_form').submit(function(e){
        e.preventDefault();
        // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        const fd = new FormData(this);
        if (
        $('#fname').val() == '' ||            
        $('#email').val() == '' ||            
        $('#phone_no').val() == '' ||            
        $('#pword').val() == '' ||            
        $('#cpword').val() == ''         
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Creating user...');
        $.ajax({
            url: '{{ route('dashboard.new.user') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status == 200) {
                    Swal.fire(
                        'User',
                        'Created Sucessfully',
                        'success'
                    );
                    $('#grade_student_form').trigger('reset');
                    $('#save-btn').text('Create');
                }else if (res.status == 300) {
                    Swal.fire(
                        'User',
                        'Not Created Sucessfully',
                        'error'
                    )
                } 
            }
        });
    }
        
    });

    $('#student_name').on('change', function(e){
            e.preventDefault();
            let id = $('#student_name').val();
            let session_ = $('#academic_session').val();
            let term = $('#academic_term').val();
            $.ajax({
                url: '{{ route('dashboard.grade.get') }}',
                method: 'get',
                data:{
                    id: id,
                    session_: session_,
                    term: term,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#firstname').val(res.fname);
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
                    $('#fullname').text(res.fname);
                    $('#family').text(res.ffname);
                    $('#pob_bio').text(res.pob);
                    $('#dob_bio').text(res.dob);
                    $('#sickness_bio').text(res.sickness_allergy);
                    $('#phone_bio').text(res.phone_no);
                    $('#email_bio').text(res.email);
                    $('.img-bio').html(`<img src="../../storage/images/${res.passport}" class="img-thumbnail">`)
                    $('#address_bio').text(res.address);
                }
            })
        })
</script>
@endsection