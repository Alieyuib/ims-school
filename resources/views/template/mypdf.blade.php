<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  {{-- <link rel="stylesheet" href="{{ asset('app-assets/css/main.css') }}"> --}}
  <title>Generate Pdf</title>
  <style>
    .invoice_table{
      /* margin-left: 200px; */
      width: 100%;
      text-align: center;
    }
    .invoice_table tr{
      margin-bottom: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8" style="text-align: center;">
        {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" style="width: 10%"> --}}
        <h2 class="text-ims-default">THE PRIORITY SCHOOL</h2>
        <h4 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h4>
        <h4 class="text-ims-orange"><b>INVOICE TO</b></h4>
        <h3 class="text-ims-default"><b>Invoice No:{{ $invoice_no }}</b></h3>
        <h4 class="text-ims-default"><b class="text-ims-orange">STUDENT NAME</b>: {{ $student_name }} <b class="text-ims-orange">EMAIL</b>: {{ $student_email }}</h4>
        <h4 class="text-ims-default"><b class="text-ims-orange">ADDRESS</b>: {{ $student_address }}</h4>
        <h4 class="text-ims-default"><b class="text-ims-orange">DATE</b>: {{ date('D/M/Y') }}</h4>
        <div id="show_cart_items">
          <table class="invoice_table">
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
                    <td>N&nbsp;{{ $item->item_price }}</td>
                  </tr>
              @endforeach
              <tr>
                <td><b>Total of N&nbsp;{{ $totalAll }}</b></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row my-5">
          <div class="col-md-12 payment">
              <h4><b>Signature/Date</b></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>