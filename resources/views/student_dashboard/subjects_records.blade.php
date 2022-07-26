
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
            fetchSubjectRecord();
        },2500);
        function fetchSubjectRecord() {
            $.ajax({
                url: '{{ route('portal.subject.record') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

    </script>
@endsection
{{-- </body>
</html> --}}

