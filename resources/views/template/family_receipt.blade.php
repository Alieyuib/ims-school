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
    .invoice_table{
      /* margin-left: 200px; */
      width: 100%;
      text-align: center;
      color: #145251;
      border: 2px solid #145251;
    }
    .invoice_table tr{
      margin-bottom: 50px;
      padding: 40px;
      /* border: 2px solid #145251; */
    }
    .total{
      float: right;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8" style="text-align: ;">
        <img style="float: left" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/logo.jpg'))) }}">
        <h2 style="color: #145251; float: right" class="text-ims-default">THE PRIORITY SCHOOL</h2>
        <h4 style="color: #d9ba79; margin-top: 40px; position: absolute; left: 200;"  class="text-dark">NO: 2 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h4>
        <div style="margin-top: 200px">
        <h3 style="color: #145251;" class="text-ims-default"><b>Receipt:#{{ $invoice_no }}</b></h3>
        <h4 style="color: #145251;" class="text-ims-default"><b class="text-ims-orange">FAMILY NAME</b>: {{ $student_ffname }}</h4>
        <h4 style="color: #145251;" class="text-ims-default"><b class="text-ims-orange">ADDRESS</b>: {{ $student_address }}</h4>
        <h4 style="color: #145251;" class="text-ims-default"><b class="text-ims-orange">DATE</b>: {{ date('D/M/Y') }}</h4>
        </div>
        <table class="invoice_table table-bordered table-striped" border="1" style="margin-bottom: 20px">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Students</th>
              </tr>
            </thead>
            <tbody style="padding: 20px">
              @foreach ($family_members as $item)
                  <tr>
                    <td>{{$counter++}}</td>
                    <td>{{ $item->name }}</td>
                  </tr>
              @endforeach
              {{-- <tr>
                <td><b>Total: &#8358;&nbsp;{{ $totalAll }}</b></td>
                <td><b>Discount: &#8358;&nbsp;{{ $discount }}</b></td>
              </tr> --}}
            </tbody>
          </table>
        <div id="show_cart_items">
          <table class="invoice_table table-bordered table-striped" border="1">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Descritption</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody style="padding: 20px">
              @foreach ($cart_items as $item)
                  <tr>
                    <td>{{$counter++}}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>N&nbsp;{{ number_format($item->item_price) }}</td>
                  </tr>
              @endforeach
              {{-- <tr>
                <td><b>Total: &#8358;&nbsp;{{ $totalAll }}</b></td>
                <td><b>Discount: &#8358;&nbsp;{{ $discount }}</b></td>
              </tr> --}}
            </tbody>
          </table>
        </div>
        <div class="row my-5">
          <div class="col-md-12">
            <table class="invoice_table" border="1" style="width: 100%; margin-top: 30px">
              <tbody>
                {{-- <tr>
                  <td><b>Tax</b></td>
                  <td><h4><b>N&nbsp;0</b></h4></td>
                </tr>
                <tr>
                  <td><b>Vat</b></td>
                  <td><b>N&nbsp;0</b></td>
                </tr> --}}
                <tr>
                  <td><b>Discount</b></td>
                  <td><b>N&nbsp;{{number_format($discount)}}</b></td>
                </tr>
                <tr>
                  <td><b>Total</b></td>
                  <td><b>N&nbsp;{{ number_format($totalAll) }}</b></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-12 payment">
              <h4 style="color: #145251; text-align: center; text-transform:uppercase"><b>Signature/Date</b></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>