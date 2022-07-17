@extends('layouts.app_student')

@section('content')
<div class="col-md-8 receipt-div card" id="receipt">
    {{-- <div class="col-md-4">
      <img src="" alt="" class="img-thumbnail">
    </div> --}}
    <div class="col-md-12 text-center">
      <h3 class="text-dark">THE PRIORITY SCHOOL</h3>
      <h5 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h5>
      <h5 class="text-success">OFFICIAL RECEIPT</h5>
      <table class="table table-bordered table-stripped" id="result-table">
        <thead>
          <tr class="text-success">
            <th>STUDENT NAME</th>
            <th>AMOUNT</th>
            <th>CLASS</th>
            <th>TERM</th>
            <th>DATE</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($student_payment_data as $item)
                <tr>
                    <td>{{ $item->fname . ' ' . $item->lname }}</td>
                    <td>&#8358;100,000</td>
                    <td>PLAY CLASS</td>
                    <td class="">2ND TERM</td>
                    <td>{{ date('D/M/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-6">
            <h6 class="text-dark">
                <b>SIGNATURE:</b>&nbsp; <span class="text-success">________________</span>
            </h6>
        </div>
        <div class="col-md-6">
            <h6 class="text-dark">
                <b>DATE:</b>&nbsp;<span class="text-success">{{ date('D/M/Y') }}</span>
            </h6>
        </div>
        <div class="col-md-12 text-center print-btn">
             <button class="btn btn-success" id="print-btn">
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