@extends('layouts.app_student')

@section('content')
<div class="col-md-8 receipt-div card" id="receipt">
    <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-receipt">
    {{-- <div class="col-md-4">
      <img src="" alt="" class="img-thumbnail">
    </div> --}}
    <div class="col-md-12 text-center">
      <h3 class="text-ims-default">THE PRIORITY SCHOOL</h3>
      <h5 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
      <h5 class="text-ims-orange">OFFICIAL RECEIPT</h5>
      <h6 class="text-ims-default" style="text-transform: uppercase">RECEIPT NO: {{ $receipt_no }} &nbsp;&nbsp;&nbsp;RECEIPT DATE: {{ $receipt_date }}</h6>
      <h6 class="text-ims-default">NAME: {{ $student_name }} &nbsp;&nbsp;&nbsp;ADDRESS: {{ $student_address }}</h6>
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
            <h6>TOTAL DUE AMOUNT:&nbsp;&#8358;128,500</h6>
        </div>
        <div class="col-md-6">
            <h6 class="text-dark">
                <b>SIGNATURE:</b>&nbsp; <span class="text-ims-default">________________</span>
            </h6>
        </div>
        <div class="col-md-6">
            <h6 class="text-dark">
                <b>DATE:</b>&nbsp;<span class="text-ims-default">{{ date('D/M/Y') }}</span>
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
<script>

    function printReceipt(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    // view result
    $(document).on('click', '#print_fee_schedule', function(e){
            e.preventDefault();
            // let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('portal.finance.view') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                }
            })

        })

        $('#print-btn').on("click", function(el){
            printReceipt('receipt')
        })

</script>
@endsection