
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
<div class="modal fade" id="gradeStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Result Confirmation Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="col-md-12 grade-form"> 
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
                    <input type="hidden" name="student_name" id="student_id">
                    <input type="text" name="student_named" class="form-control" id="student_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="student_class">STUDENT CLASS</label>
                    <input type="text" name="student_class" id="student_class" class="form-control">
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
                    <input type="text" name="academic_term" id="academic_term" placeholder="Academic Term" class="form-control">
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
                    <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Submit Result <i class="fa fa-bookmark-o"></i></button>
                </div>
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
            <h3 class="text-success">All Students Scores(تسجيل جميع الطلاب)</h3>
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
                url: '{{ route('dashboard.records') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        // update scores ajax 
        $('#grade_student_form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#grade_student_btn').text('Submitting....');
            $.ajax({
                url: '{{ route('dashboard.grade.student') }}',
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
                            'Result',
                            'Submitted Successfully',
                            'success'
                        );
                        $('#grade_student_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#grade_student_btn').text('Submit Result');
                        fetchAllStudents();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Result',
                            'Not Submitted',
                            'error'
                        );
                        $('#grade_student_btn').text('Submit Result');
                    } 
                }
            })
        })

        // grade data ajax
        $(document).on('click', '.gradeIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('portal.teacher.subject') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    $('#student_name').val(res.data.student_name);
                    $('#student_id').val(res.data.student_id);
                    $('#student_class').val(res.data.student_class);
                    $('#academic_term').val(res.data.academic_term);
                    $('#academic_session').val(res.data.academic_session);

                    // scores values
                    $('#quran').val(res.data.sub_one_scores)
                    $('#azkar').val(res.data.sub_two_scores)
                    $('#huruf').val(res.data.sub_three_scores)
                    $('#arabiyya').val(res.data.sub_four_scores)
                }
            })

        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

