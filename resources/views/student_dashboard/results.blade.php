
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
@extends('layouts.app_student')

@section('content')
{{-- <body class="bg-dark"> --}}
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modal-color">
        <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">RESULT FOR <span id="student-name" style="text-transform: uppercase">{{ $loggedInName }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row">
          <div class="col-md-4">
            <img src="" alt="" class="img-thumbnail">
          </div>
          <div class="col-md-8">
            <h3 class="text-light">THE PRIORITY SCHOOL</h3>
          </div>
        </div>
        <div class="row result-header">
          <h5 class="text-light">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
          <h6 class="text-warning">REPORT SHEET</h6>
          <h6 class="text-light student-name"><b>STUDENT NAME:</b> {{ $loggedInName }}</h6>
          <h6 class="text-dark result_data">
            <span id="term_id"><b>TERM:</b> 3RD</span>
            <span class="date_result"><b>DATE:</b> 15/07/2021</span>
            <span class="class_result"><b>CLASS:</b> PLAY CLASS</span>
          </h6>
          <h6 class="text-warning result_average">
            <span class="date_result"><b>AVERAGE:</b> 33%</span>
            <span class="class_result"><b>NO OF STUDENTS IN THE CLASS:</b> 17</span>
          </h6>
        </div>
        <div class="row result-body">
          <div class="col-md-10 bg-light" id="result-table-div">
            <table class="table table-bordered table-stripped" id="result-table">
              <thead>
                <tr class="text-success">
                  <th>GRADE</th>
                  <th>EXPECTED SCORES</th>
                  <th>SCORES</th>
                  <th>SUBJECT</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="grade_letter_quran"></td>
                  <td>100</td>
                  <td class="grade_score_quran"></td>
                  <td>AL-QURAN</td>
                </tr>
                <tr>
                  <td class="grade_letter_azkar"></td>
                  <td>100</td>
                  <td class="grade_score_azkar"></td>
                  <td>AL-AZKAR</td>
                </tr>
                <tr>
                  <td>A</td>
                  <td>100</td>
                  <td>90</td>
                  <td>QURAN</td>
                </tr>
                <tr>
                  <td>A</td>
                  <td>100</td>
                  <td>90</td>
                  <td>QURAN</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <form action="#" method="POST" id="edit_student_form" enctype="multipart/form-data" class="reg-form">
            @csrf
            <input type="hidden" name="student_id" id="student_id">
        </form>
    </div>
    </div>
</div>
{{-- edit student modal end --}}
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">MY RESULTS</h3>
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
        },2000);
        function fetchAllStudents() {
            $.ajax({
                url: '{{ route('portal.get.result') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        // view result
        $(document).on('click', '.view-result', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('portal.result.single') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                }
            })

        })
    </script>
@endsection

