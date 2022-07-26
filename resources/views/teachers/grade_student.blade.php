
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
@extends('layouts.app_teacher')

@section('content')
{{-- <body class="bg-dark"> --}}
<div class="modal fade" id="gradeStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subject Grading Form {{ $loggedInSubject }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="reg-modal-form">
        @csrf
        <input type="hidden" name="student_id" id="student_id">
        <div class="modal-body p-4 bg-light">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="fname">Fullname</label>
                    <input type="hidden" class="form-control" name="subject_id" id="subject_id">
                    <input type="hidden" class="form-control" name="subject_name" id="subject_name">
                    <input type="text" class="form-control" name="fname" placeholder="Fullname" id="fname">
                </div>
                <div class="form-group col-md-4">
                    <label for="student_class">Student Class</label>
                    <input type="text" class="form-control" name="student_class" placeholder="Student Class" id="student_class">
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="no_in_class">No In Class</label>
                    <input type="number" class="form-control" name="no_in_class" placeholder="Student Class" id="no_in_class">
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="academic_term">Academic Term</label>
                    <input type="text" class="form-control" name="academic_term" placeholder="Academic Term" id="academic_term">
                </div>
                <div class="form-group col-md-4">
                    <label for="academic_session">Academic Session</label>
                    <input type="text" class="form-control" name="academic_session" placeholder="Academic Session" id="academic_session">
                </div>
                <div class="form-group col-md-4">
                    <label for="subject_marks">Subject Marks</label>
                    <input type="number" class="form-control" name="subject_marks" placeholder="Subject Marks" id="subject_marks">
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="subject_grade">Grade</label>
                    <select name="subject_grade" id="subject_grade" class="form-control">
                        <option value="A">EXCELLENT</option>
                        <option value="B">VERY GOOD</option>
                        <option value="C">GOOD</option>
                        <option value="D">FAIR GOOD</option>
                        <option value="F">FAIR</option>
                    </select> 
                </div> --}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="grade_student_btn" class="btn btn-primary">Grade</button>
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
            <h3 class="text-success">All Students Taking {{ $loggedInSubject }} (تسجيل جميع الطلاب)</h3>
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
                url: '{{ route('portal.teacher.grades') }}',
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
            $('#grade_student_btn').text('Saving....');
            $.ajax({
                url: '{{ route('portal.teacher.scores') }}',
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
                            'Scores',
                            'Recorded Successfully',
                            'success'
                        );
                        $('#grade_student_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#grade_student_btn').text('Grade');
                        fetchAllStudents();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Scores',
                            'Not Recorded',
                            'error'
                        );
                        $('#grade_student_btn').text('Grade');
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
                    $('#fname').val(res.data.student_name);
                    $('#subject_id').val(res.data.id);
                    $('#student_id').val(res.data.student_id);
                    $('#student_class').val(res.data.student_class);
                    $('#academic_term').val(res.data.academic_term);
                    $('#academic_session').val(res.data.academic_session);
                    $('#subject_name').val(res.subject_name);
                }
            })

        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

