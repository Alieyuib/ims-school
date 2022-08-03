@extends('layouts.app_student')

@section('content')
<form action="#" method="POST" id="course_student_form" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h5 class="text-ims-default">SUBJECT REGISTRATION FORM</h5>
        </div>
    </div>
    @csrf
    <div class="row">
        <h5>STUDENT DATA</h5>
        <div class="form-group col-md-12">
            <label for="student_id">STUDENT NAME</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach ($students as $item)
                    <option value="{{ $item->id }}">{{ $item->fname }}</option>
                @endforeach
            </select>
            <input type="hidden" name="student_name" id="student_name">
            {{-- <input type="text" name="student_name" class="form-control" id="student_name" placeholder="Student Name" value="{{ $student_name }}">
            <input type="hidden" name="student_id" value="{{ $student_id }}"> --}}
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
            <label for="academic_session">ACADEMIC SESSION</label>
            <input type="text" class="form-control" name="academic_session" placeholder="ACADEMIC SESSION" id="academic_session">
        </div>
        <div class="form-group col-md-4">
            <label for="academic_term">ACADEMIC TERM</label>
            <select name="academic_term" id="academic_term" class="form-control">
                <option value="1">FIRST TERM</option>
                <option value="2">SECOND TERM</option>
                <option value="3">THIRD TERM</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="al-quran">AL-QUR'AN (القرأن)</label>
            <input type="text" name="al-quran" class="form-control" id="al-quran"  value="القرأن">
            <input type="hidden" name="al_quran" value="al-quran">
        </div>
        <div class="form-group col-md-4">
            <label for="al-azkar">AL-AZKAR (الازكار)</label>
            <input type="text" name="al-azkar" class="form-control" id="al-azkar" value="الازكار">
            <input type="hidden" name="al_azkar" value="al-azkar">
        </div>
        <div class="form-group col-md-4">
            <label for="al-huruf">AL-HURUF (الحروف)</label>
            <input type="text" name="al-huruf" class="form-control" id="al-huruf" value="الحروف">
            <input type="hidden" name="al_huruf" value="al-huruf">
        </div>
        <div class="form-group col-md-4">
            <label for="al-arabiyya">AL-ARABIYYA (العربية)</label>
            <input type="text" name="al-arabiyya" class="form-control" id="al-arabiyya" value="العربية">
            <input type="hidden" name="al_arabiyya" value="al-arabiyya">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">REGISTER <i class="fa fa-book"></i></button>
        </div>
    </div>
</form>
<script>

$('#student_id').on('change', function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '{{ route('portal.biodata.get') }}',
                method: 'get',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#student_name').val(res.fname);
                }
            })
        })

$('#course_student_form').submit(function(e){
        e.preventDefault();
        // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        const fd = new FormData(this);
        if (
        $('#student_name').val() == '' ||            
        $('#academic_session').val() == '' ||            
        $('#academic_term').val() == '' ||            
        $('#student_class').val() == '' ||            
        $('#al-quran').val() == '' ||            
        $('#al-azkar').val() == '' ||            
        $('#al-huruf').val() == '' ||            
        $('#al-arabiyya').val() == ''            
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Registering...');
        $.ajax({
            url: '{{ route('portal.courses.registration') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status == 200) {
                    Swal.fire(
                        'Course',
                        'Registration Sucessfully',
                        'success'
                    );
                    $('#course_student_form').trigger('reset');
                    $('#save-btn').text('REGISTER');
                }else if (res.status == 300) {
                    Swal.fire(
                        'Course',
                        'Registration Not Sucessfully',
                        'error'
                    )
                } 
            }
        });
    }
        
    });

</script>
@endsection