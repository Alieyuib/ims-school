@extends('layouts.app')

@section('content')
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="" id="receipt">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-receipt">
            {{-- <div class="col-md-4">
              <img src="" alt="" class="img-thumbnail">
            </div> --}}
            <div class="col-md-12 text-center">
              <h3 class="text-ims-default">THE PRIORITY SCHOOL</h3>
              <h5 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
              <h5 class="text-ims-orange">OFFICIAL RECEIPT</h5>
              <h6 class="text-ims-default" style="text-transform: uppercase">RECEIPT NO: <span id="invoice_no"></span>  &nbsp;RECEIPT DATE:<span id="invoice_date"></span> </h6>
              <h6 class="text-ims-default">NAME: <span id="invoice_name"></span></h6>
              <table class="table table-bordered table-stripped" id="result-table">
                <thead>
                  <tr class="text-ims-default">
                    <th>S/N</th>
                    <th>ITEM DESCRIPTION</th>
                    <th>TOTAL DUE AMOUNT</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Tuition Fee For 1st Term 2021</td>
                        <td>&#8358;68,000.00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Tuition Fee For 2nd Term 2021</td>
                        <td>&#8358;50,000.00</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>A complete Set of Uniform</td>
                        <td>&#8358;10,500.00</td>
                    </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                    <h6>TOTAL AMOUNT PAID:&nbsp;&#8358;<span id="invoice_amount"></span></h6>
                    <h6>BALANCE AMOUNT:&nbsp;&#8358;<span id="invoice_balance"></span></h6>
                </div>
                <div class="col-md-6">
                    <h6 class="text-dark">
                        <b>SIGNATURE:</b>&nbsp; <span class="text-ims-default">________________</span>
                    </h6>
                </div>
                <div class="col-md-6">
                    <h6 class="text-dark">
                        <b>DATE:</b>&nbsp;<span class="text-ims-default" id="invoice_date_2"></span>
                    </h6>
                </div>
                <div class="col-md-12 text-center print-btn">
                     <button class="btn btn-ims-green" id="print-btn">
                        <i class="fa fa-print"></i>&nbsp; PRINT RECEIPT
                     </button>
                </div>
              </div>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="container">
    <div class="row my-1">
      <div class="col-lg-12 student-list-div">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Generate Invoice(تسجيل جميع الطلاب)</h3>
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
    <script>
        // Fetch All Employee
        setTimeout(() => {
            fetchAllTransactions();
        },2500);

        function fetchAllTransactions() {
            $.ajax({
                url: '{{ route('dashboard.logs.generate') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        $(document).on('click', '.generateIcon', function(e){
            e.preventDefault();
            let id  = $(this).attr('id');
            $.ajax({
                url: '{{ route('get.invoice.data') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Invoice',
                            'Generated',
                            'success'
                        );
                        // fetchAllTransactions();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Invoice',
                            'Generated',
                            'error'
                        );
                    }
                }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

