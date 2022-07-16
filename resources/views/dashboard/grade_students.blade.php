@extends('layouts.app')

@section('content')
<div class="card col-md-8 grading-container">
    <h5 class="text-success"><i class="fa fa-bookmark"></i>&nbsp;GRADING FORM</h5>
    <form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="reg-form">
        @csrf
            <div class="row">
                <h5>STUDENT DATA</h5>
                <div class="form-group col-md-4">
                    <label for="student_name">STUDENT NAME</label>
                    <select name="student_name" id="student_name" class="form-control" style="text-transform: uppercase">
                        @foreach ($student_list as $item)
                            <option value="{{ $item->id }}">{{ $item->fname . ' ' . $item->lname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="student_class">STUDENT CLASS</label>
                    <input type="number" class="form-control" name="student_class" placeholder="CLASS" id="student_class">
                </div>
                <div class="form-group col-md-4">
                    <label for="no_in_class">NO IN CLASS</label>
                    <input type="number" class="form-control" name="no_in_class" placeholder="NO IN CLASS" id="no_in_class">
                </div>
                <div class="form-group col-md-4">
                    <label for="academic_session">ACADEMIC SESSION</label>
                    <input type="date" class="form-control" name="academic_session" placeholder="ACADEMIC SESSION" id="academic_session">
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
                    <label for="quran">AL-QUR'AN</label>
                    <input type="number" class="form-control" name="quran" placeholder="AL-QUR'AN" id="quran">
                </div>
                <div class="form-group col-md-6">
                    <label for="azkar">AL-AZKAR</label>
                    <input type="number" class="form-control" name="azkar" placeholder="AL-AZKAR" id="azkar">
                </div>
                <div class="form-group col-md-6">
                    <label for="huruf">AL-HURUF</label>
                    <input type="number" class="form-control" name="huruf" placeholder="AL-HURUF" id="huruf">
                </div>
                <div class="form-group col-md-6">
                    <label for="arabiyya">AL-ARABIYYA</label>
                    <input type="number" class="form-control" name="arabiyya" placeholder="AL-ARABIYYA" id="arabiyya">
                </div>
                <div class="form-group col-md-12">
                   <button class="btn btn-success" type="submit" id="save-btn">GRADE <i class="fa fa-bookmark-o"></i></button>
                </div>
            </div>
        </form>
</div>
<script>
    // Grade Student
    // $("#student_name").val() == 'SELECT STUDENT';
    Array.range = function(a, b, step){
        var A = [];
        if(typeof a == 'number'){
            A[0] = a;
            step = step || 1;
            while(a+step <= b){
                A[A.length]= a+= step;
            }
        }
        else {
            var s = 'abcdefghijklmnopqrstuvwxyz';
            if(a === a.toUpperCase()){
                b = b.toUpperCase();
                s = s.toUpperCase();
            }
            s = s.substring(s.indexOf(a), s.indexOf(b)+ 1);
            A = s.split('');        
        }
        return A;
    }
    $('#quran').on('change', function(){
        if ($('#quran').val() == Array.range(79,100)) {
            $('#quran').addClass("text-success");
        }
    })
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
</script>
@endsection