<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  {{-- <link rel="stylesheet" href="{{ asset('app-assets/css/main.css') }}"> --}}
  <title>Generate Pdf</title>
  <style>
    
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <h3>{{$student_email}}</h3>
      <h3>Your Invoice: #{{ $invoice_no }}</h3>
    </div>
  </div>
</body>
</html>