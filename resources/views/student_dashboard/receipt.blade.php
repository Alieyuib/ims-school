@extends('layouts.app_student')

@section('content')
<div class="col-md-8 receipt-div card shadow" id="receipt">
    <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-receipt">
    {{-- <div class="col-md-4">
      <img src="" alt="" class="img-thumbnail">
    </div> --}}
    <div class="col-md-12 text-center">
      <h3 class="text-ims-default">THE PRIORITY SCHOOL</h3>
      <h5 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
      <h5 class="text-ims-orange">SCHOOL FEE SCHEDULE</h5>
      <h6 class="text-ims-default" style="text-transform: uppercase">DATE: {{ $receipt_date }}</h6>
      {{-- <h6 class="text-ims-default">NAME: {{ $student_name }} &nbsp;&nbsp;&nbsp; <br> ADDRESS: {{ $student_address }}</h6> --}}
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
                <td>Tuition Fee For 1st Term</td>
                <td>&#8358;80,000.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tuition Fee For 2nd Term</td>
                <td>&#8358;60,000.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tuition Fee For 2nd Term</td>
                <td>&#8358;60,000.00</td>
            </tr>
            <tr>
                <td></td>
                <td><b>Per Annum</b></td>
                <td><b>&#8358;200,000.00</b></td>
            </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-12 text-center">
            <H5>ACCOUNT DETAILS</H5>
            <h6><b>Account Name:</b>&nbsp;The Priority School</h6>
            <h6><b>Account Number:</b>&nbsp;0002044118</h6>
            <h6><b>Bank Name:</b>&nbsp;Jaiz Bank PLC</h6>
            {{-- <h6><b>Account Name:</b>&nbsp;The Priority School</h6> --}}
        </div>
        {{-- <div class="col-md-6">
            <h6 class="text-dark">
                <b>SIGNATURE:</b>&nbsp; <span class="text-ims-default">________________</span>
            </h6>
        </div> --}}
        <div class="col-md-12">
            <h6 class="text-dark">
                
            </h6>
        </div>
        <div class="col-md-12 text-center print-btn">
             <button class="btn btn-ims-green" id="print-btn">
                <i class="fa fa-print"></i>&nbsp; PRINT
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