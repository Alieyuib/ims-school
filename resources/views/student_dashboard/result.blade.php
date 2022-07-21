
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
<div class="col-md-12 text-center">
    
</div>
<div class="col-md-8 card result-div" id="result">
    <div class="row result-header">
        <div class="col-md-12">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="img-result">
            <h3 class="text-ims-default">THE PRIORITY SCHOOL</h3>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h6>
            <h5 class="text-ims-orange">OFFICIAL RESULT</h5>
            <h6 class="text-ims-default">STUDENT NAME <b>(أسم الطالب)</b>: &nbsp;{{ $student_name }}</h6>
            <h6 class="text-ims-default">TERM <b>(مصطلح)</b>: {{ $term }}RD &nbsp;&nbsp;&nbsp; DATE <b>(تاريخ)</b>: {{ $session }}&nbsp;&nbsp;&nbsp; CLASS <b>(صف دراسي)</b>: CLASS {{ $class }} </h6>
            <h6 class="text-ims-default">AVERAGE <b>(معدل)</b>: {{ $total_average }} &nbsp;&nbsp;&nbsp; NO IN CLASS <b>(رقم في الفصل)</b>: {{ $no_in_class }} </h6>
        </div>
    </div>
    <div class="row result-body">
        <table class="col-md-12 table-bordered table-striped" id="result-data-table">
            <thead class="ims-bg-green text-light">
                <tr class="text-center">
                    <th>
                        <h6><b>المرتبة</b></h6>
                        <h6>GRADE</h6>
                    </th>
                    <th>
                        <h6><b>النتائج المتوقعة</b></h6>
                        <h6>EXPECTED SCORES</h6>
                    </th>
                    <th>
                        <h6><b>درجات</b></h6>
                        <h6>SCORES</h6>
                    </th>
                    <th>
                        <h6><b>موضوعات</b></h6>
                        <h6>SUBJECTS</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $quran_grade }}</td>
                    <td>100</td>
                    <td>{{ $quran }}</td>
                    <td class="btn-ims-green">
                        <h6>القرآن</h6>
                        <h6>AL-QURAN</h6>
                    </td>
                </tr>
                <tr>
                    <td>{{ $azkar_grade }}</td>
                    <td>100</td>
                    <td>{{ $azkar }}</td>
                    <td class="btn-ims-green">
                        <h6>ازکار</h6>
                        <h6>AL-AZKAR</h6>
                    </td>
                </tr>
                <tr>
                    <td>{{ $huruf_grade }}</td>
                    <td>100</td>
                    <td>{{ $huruf }}</td>
                    <td class="btn-ims-green">
                        <h6>حُرُوف</h6>
                        <h6>AL-HURUF</h6>
                    </td>
                </tr>
                <tr>
                    <td>{{ $arabiyya_grade }}</td>
                    <td>100</td>
                    <td>{{ $arabiyya }}</td>
                    <td class="btn-ims-green">
                        <h6>العربية</h6>
                        <h6>AL-ARABIYA</h6>
                    </td>
                </tr>
                <tr class="">
                    <td>TOTAL</td>
                    <td>400</td>
                    <td>{{ $total_scores }}</td>
                    <td class="btn-ims-green">
                        <h6>المجموع</h6>
                        <h6>TOTAL</h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-12 text-center result-remarks">
            <h6 class="text-ims-default">Class Teacher's Remarks/Sign______________________________________________(ملاحظات مدرس الفصل/إشارة)</h6>
            <h6 class="text-ims-default">Head Teacher's Remarks/Sign______________________________________________(ملاحظات مدير المدرسة/إشارة)</h6>
            <h5 class="text-ims-orange">Resumption Date(تاريخ الاستئناف): 04/11/2022</h5>
            <button class="btn btn-ims-green" id="print_result_data">PRINT RESULT</button>
        </div>
    </div>
</div>
    <script>

      function printResult(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
      };

      $('#print_result_data').on('click', function(){
        printResult('result');
      });
    </script>
@endsection

