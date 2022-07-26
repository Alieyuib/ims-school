@extends('layouts.app')

@section('content')

<form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
        </div>
    </div>
    @csrf
    <div class="row">
        <h5>STUDENT DATA</h5>
        <div class="form-group col-md-4">
            <label for="student_name">STUDENT NAME</label>
            <select name="student_name" id="student_name" class="form-control" style="text-transform: uppercase">
                @foreach ($student_list as $item)
                    <option value="{{ $item->id }}">{{ $item->id . $item->fname}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="student_class">STUDENT CLASS</label>
            <select name="student_class" id="student_class" class="form-control">
                @foreach ($classes as $item)
                    <option value="{{ $item->class_name }}">{{ $item->class_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="no_in_class">NO IN CLASS</label>
            <input type="number" class="form-control" name="no_in_class" placeholder="NO IN CLASS" id="no_in_class">
        </div>
        <div class="form-group col-md-4">
            <label for="academic_session">ACADEMIC SESSION</label>
            <input type="text" class="form-control" name="academic_session" placeholder="ACADEMIC SESSION" id="academic_session" value="{{ date('Y') }}">
        </div>
        <div class="form-group col-md-4">
            <label for="academic_term">ACADEMIC TERM</label>
            <select name="academic_term" id="academic_term" class="form-control">
                <option value="1">FIRST TERM</option>
                <option value="2">SECOND TERM</option>
                <option value="3">THIRD TERM</option>
            </select>
        </div>
        <div class="col-md-12">
            <h5>SUBJECTS GRADE</h5>
        </div>
        <div class="form-group col-md-6">
            <label for="quran">AL-QUR'AN (القرأن)</label>
            <input type="number" class="form-control" name="quran" placeholder="القرأن" id="quran">
            <label for="quran_grade">GRADE</label>
            <select name="quran_grade" id="quran_grade" class="form-control">
                <option value="A">EXCELLENT</option>
                <option value="B">VERY GOOD</option>
                <option value="C">GOOD</option>
                <option value="D">FAIR GOOD</option>
                <option value="F">FAIR</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="azkar">AL-AZKAR (الازكار)</label>
            <input type="number" class="form-control" name="azkar" placeholder="الازكار" id="azkar">
            <label for="azkar_grade">GRADE</label>
            <select name="azkar_grade" id="azkar_grade" class="form-control">
                <option value="A">EXCELLENT</option>
                <option value="B">VERY GOOD</option>
                <option value="C">GOOD</option>
                <option value="D">FAIR GOOD</option>
                <option value="F">FAIR</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="huruf">AL-HURUF (الحروف)</label>
            <input type="number" class="form-control" name="huruf" placeholder="الحروف" id="huruf">
            <label for="huruf_grade">GRADE</label>
            <select name="huruf_grade" id="huruf_grade" class="form-control">
                <option value="A">EXCELLENT</option>
                <option value="B">VERY GOOD</option>
                <option value="C">GOOD</option>
                <option value="D">FAIR GOOD</option>
                <option value="F">FAIR</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="arabiyya">AL-ARABIYYA (العربية)</label>
            <input type="number" class="form-control" name="arabiyya" placeholder="العربية" id="arabiyya">
            <label for="arabiyya_grade">GRADE</label>
            <select name="arabiyya_grade" id="arabiyya_grade" class="form-control">
                <option value="A">EXCELLENT</option>
                <option value="B">VERY GOOD</option>
                <option value="C">GOOD</option>
                <option value="D">FAIR GOOD</option>
                <option value="F">FAIR</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">GRADE <i class="fa fa-bookmark-o"></i></button>
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
        $('#student_name').val() == '' ||            
        $('#academic_session').val() == '' ||            
        $('#academic_term').val() == '' ||            
        $('#quran').val() == '' ||            
        $('#azkar').val() == '' ||            
        $('#huruf').val() == '' ||            
        $('#arabiyya').val() == ''            
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Grading...');
        $.ajax({
            url: '{{ route('dashboard.grade.student') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status == 200) {
                    Swal.fire(
                        'Student',
                        'Grade Sucessfully Recorded',
                        'success'
                    );
                    $('#grade_student_form').trigger('reset');
                    $('#save-btn').text('Grade');
                }else if (res.status == 300) {
                    Swal.fire(
                        'Student',
                        'Grade Not Sucessfully Recorded',
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