<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app-assets/css/main.css') }}">
    <link rel="stylesheet" type = "text/css" media="screen" href="{{ asset('app-assets/css/print.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('app-assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Generate Pdf</title>
  <style>
    body{
      background-color: #ffffff !important;
    }
    .header_image{
        width: 100%;
    }
    .header_info p{
        text-align: center;
    }
    table{
            border: 1px solid #ddd;
            width: 100%;
            padding: 10px;
        }
        thead tr th{
            border: 1px solid #fff;
            padding: 5px;
            background-color: #007c36;
            color: #fff;
        }
        thead th{
            font-size: 14px;
        }
        /* tbody tr td{
          padding: 30px;
        } */
        tbody tr td{
            font-size: 18px;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            background-color: #28543b;
            color: #fff;
            /* font-weight: bold; */
            text-transform: uppercase;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="text-align: ;">
        <img class="header_image" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/priority_result_header.jpg'))) }}">
      </div>
      <div class="col-md-12 header_info">
        <p style="font-size: 18px; text-transform:uppercase;"><b style="color: #28543b;">Student’s Name:</b>&nbsp;{{$result_data->student_name}}</p>
        <p style="font-size: 18px; text-transform:uppercase;"><b style="color: #28543b;">Class:</b>&nbsp;{{$result_data->student_class}}&nbsp;&nbsp;&nbsp;<b style="color: #28543b;">Date:</b>&nbsp;20/05/2023&nbsp;&nbsp;&nbsp;<b style="color: #28543b;">Term:</b>&nbsp;{{$result_data->term}}</p>
        <p style="font-size: 18px; text-transform:uppercase;"><b style="color: #28543b;">No. of students in Class:</b>&nbsp;{{$result_data->no_in_class}}&nbsp;&nbsp;&nbsp;<b style="color: #28543b;">Average:</b>&nbsp;{{$result_data->average}}</p>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered" style="margin-top:0px;">
            <thead>
                <tr>
                  <th>GRADE</th>
                  <th>EXPECTED SCORES</th>
                  <th>OBTAINED SCORES</th>
                  <th>EXAMS SCORES (50)</th>
                  <th>CA SCORES (30)</th>
                  <th>CW SCORES (20)</th>
                  <th>SUBJECT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{$result_data->grade_quran}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_quran}}</td>
                  <td>{{$result_data->exams_scores_quran}}</td>
                  <td>{{$result_data->ca_scores_quran}}</td>
                  <td>{{$result_data->cw_scores_quran}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">QURAN</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_arabic}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_arabic}}</td>
                  <td>{{$result_data->exams_scores_arabic}}</td>
                  <td>{{$result_data->ca_scores_arabic}}</td>
                  <td>{{$result_data->cw_scores_arabic}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">ARABIC</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_hadith}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_hadith}}</td>
                  <td>{{$result_data->exams_scores_hadith}}</td>
                  <td>{{$result_data->ca_scores_hadith}}</td>
                  <td>{{$result_data->cw_scores_hadith}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">Al-Hadith</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_azkar}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_azkar}}</td>
                  <td>{{$result_data->exams_scores_azkar}}</td>
                  <td>{{$result_data->ca_scores_azkar}}</td>
                  <td>{{$result_data->cw_scores_azkar}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">Al-Azkar</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_huruf}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_huruf}}</td>
                  <td>{{$result_data->exams_scores_huruf}}</td>
                  <td>{{$result_data->ca_scores_huruf}}</td>
                  <td>{{$result_data->cw_scores_huruf}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">Al-Huruf</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_muhadatha}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_muhadatha}}</td>
                  <td>{{$result_data->exams_scores_muhadatha}}</td>
                  <td>{{$result_data->ca_scores_muhadatha}}</td>
                  <td>{{$result_data->cw_scores_muhadatha}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">Al-Muhadatha</td>
                </tr>
                <tr>
                  <td>{{$result_data->grade_sirrah}}</td>
                  <td>100</td>
                  <td>{{$result_data->obtained_scores_sirrah}}</td>
                  <td>{{$result_data->exams_scores_sirrah}}</td>
                  <td>{{$result_data->ca_scores_sirrah}}</td>
                  <td>{{$result_data->cw_scores_sirrah}}</td>
                  <td style="background-color: #007c36 !important; color: #fff;">As-sirrah</td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <td><b>700</b></td>
                  <td>457</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="background-color: #007c36 !important; color: #fff;">Total</td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="col-md-12 header_info" style="margin-top: 20px;">
        <p style="font-size: 16px;"><b style="color: #28543b; text-transform:uppercase;">Class Teacher’s Remark:</b>&nbsp;{{$result_data->class_teacher_remarks}}</p>
        <p style="font-size: 16px;"><b style="color: #28543b; text-transform:uppercase;">Head Teacher’s Remark:</b>&nbsp;{{$result_data->head_teacher_remarks}}</p>
        <p style="font-size: 16px;"><b style="color: #28543b; text-transform:uppercase;">Signature:</b>&nbsp;</p>
      </div>
    </div>
  </div>
</body>
</html>