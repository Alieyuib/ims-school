@extends('layouts.app_student')

@section('content')
<div class="container">
    <div class="row my-1">
      <div class="col-lg-7 student-list-div-2" id="invoice">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Invoice #{{ $invoice_no }}</h3>
            <div class="col-md-3 text-center" style="height: 50px; border: 5px dotted #145251; margin-left:250px">
              <h3 style="text-transform: uppercase; font-weight:bold;">{{ $invoice_status }}</h3>
            </div>
          </div>
          <div class="card-body bg-orange text-center" id="show_all_students">
              <h3 class="text-ims-default">THE PRIORITY SCHOOL</h3>
              <h5 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
              <h5 class="text-ims-orange">OFFICIAL INVOICE</h5>
              <h6 class="text-ims-default" style="text-transform: uppercase">INVOICE DATE: {{ $invoice_created_at }}</h6>
              <h6 class="text-ims-default">EMAIL: {{ $invoice_to_who }}</h6>
              <table class="table table-bordered table-stripped" id="result-table">
                <thead>
                  <tr class="text-ims-default text-center">
                    <th>S/N</th>
                    <th>Student Name</th>
                    <th>Description</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($family_members as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Tuition fee per annum</td>
                            <td>&#8358;200,000</td>
                            {{-- <td>{{ $family_name }}</td> --}}
                        </tr>
                    @endforeach
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><b>TOTAL&nbsp;&#8358;{{ $invoice_amount }}</b></td>
                    </tr>
                </tbody>
              </table>
              <div class="row my-2">
                <div class="col-md-12 payment">
                  <button class="btn-lg btn-ims-green" style="width: 100%">Pay Now</button>
                </div>
                <div class="col-md-12 tool my-4">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark" id="print_btn"><i class="fa fa-print"></i>&nbsp;Print</button>
                    <button type="button" class="btn btn-ims-orange" id="download_btn"><i class="fa fa-download"></i>&nbsp;Download</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script>
        
        function printReceipt(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
        }

        $('#print_btn').on("click", function(el){
            printReceipt('invoice')
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

