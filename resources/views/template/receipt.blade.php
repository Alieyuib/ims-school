<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous"> --}}
    <style>
        .responsive-img{
            /* height: 40px; */
            /* margin-bottom: 40px;  */
            width: 100%;
        }
        .address{
            font-size: 20px;
            font-weight: lighter;
            text-transform: uppercase;
            width: 40%;
            /* margin-top: 60px; */
            margin-bottom: 30px;
        }
        .footer{
            font-size: 24px;
            font-weight: lighter;
            /* text-transform: uppercase; */
            /* width: 40%; */
            margin-top: 20px;
            /* margin-bottom: 30px; */
        }
        /* .date{
            margin-left: 50px;
        } */
        table{
            border: 1px solid #ddd;
            width: 100%;
            padding: 10px;
        }
        thead tr th{
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #28543b;
            color: #fff;
        }
        thead th{
            font-size: 18px;
        }
        tbody tr td{
            font-size: 18px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        ul{
            list-style-type: decimal;
        }
        ul li{
            font-size: 22px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="row user-profile mt-1 ml-0 mr-0">
        <img class="responsive-img" alt="" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/receipt_header_school.jpg'))) }}">
    </div>
    <div style="padding: 30px;">
        <div>
            <p class="date" style="">
                <span style="float: left; width:50%;">
                    {{-- <em style="font-size: 20px">BILL TO</em><br> --}}
                    <em style="font-size: 18px">{{ $student_name }}</em><br />
                    <em style="font-size: 18px">{{ $student_address }}</em>
                </span>
                <span style="float:right; width:50%; margin-right: -100px">
                    <em style="font-size: 18px"><b>Receipt Number:</b> {{$invoice_no}}</em><br>
                    <em style="font-size: 18px"><b>Receipt Date:</b> <?php echo date('d M Y') ?></em><br>
                  </span>
            </p> <br /><br><br><br>
            {{-- <p style="margin-bottom: 20px;">
                <em style="font-size: 25px"><b>Receipt Number:</b> {{$invoice_no}}</em><br>
                    <em style="font-size: 25px"><b>Receipt Date:</b> <?php //echo date('d M Y') ?></em><br>
                    {{-- <em style="font-size: 25px"><b>Payment Due:</b> <?php //echo date('d M Y') ?></em><br> --}}
                    {{-- <em style="font-size: 25px"><b>Due Balance: N{{ number_format($totalAll) }}</b></em><br>
            </p> --}}
        </div>
        <table class="table table-bordered" style="margin-top:40px;">
            <thead>
                <tr>
                  <th>S/N</th>
                  <th>Descritption</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($cart_items as $item)
                <tr>
                  <td>{{$counter++}}</td>
                  <td>{{ $item->item_name }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>N&nbsp;{{ number_format($item->item_price) }}</td>
                </tr>
            @endforeach
                @if ($discount > 1)
                    <tr>
                        <td><b>DISCOUNT</b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                        <td><b>N{{number_format($discount)}}</b></td>
                    </tr>
                @endif
                {{-- <tr>
                    <td><b>VAT 7.5%</b></td>
                    <td><b>&#8358; {{number_format($quotation_vat)}}</b></td>
                </tr> --}}
                <tr>
                    <td><b>TOTAL</b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b>N{{number_format($totalAll)}}</b></td>
                </tr>
            </tbody>
        </table>
        {{-- <div>
            <h2 style="margin-top:40px; text-decoration:underline"><b>Notes/Terms:</b></h2>
         </div>
         <div>
            <p class="footer" style="text-transform: uppercase;">
                Please pay: <br />
                Account name: Quadco Consults <br />
                Bank name: United bank of Africa (UBA) <br />
                Account number: 1025209191 <br />
            </p>
         </div> --}}
         {{-- <div>
            <p class="footer">
                We look forward to an opportunity to discuss this matter further.
            </p>
        </div>
        <div>
            <p class="footer">
                Best Regards,<br>
                <span>ABDULLAHI ZUAIRU</span>
            </p>
        </div> --}}
    </div>
    <div class="row user-profile mt-1 ml-0 mr-0">
      <div class="col-md-12 payment">
        <h4 style="color: #000; text-align: center; text-transform:uppercase"><b>Signature/Date</b></h4>
        <h4 style="text-align: center; text-transform:uppercase">
          <img style="width: 200px; height: 40px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/signature.png'))) }}">
        </h4>
        {{-- </h4> --}}
        <h3 style="color: #000; text-align: center; text-transform:uppercase"><b>{{ date('d M Y') }}</b></h3>
    </div>
        {{-- <img style="margin-top: 50px; width: 100%;" alt="" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('app-assets/images/invoice/quotation_footer.jpg'))) }}"> --}}
    </div>
</body>
</html>