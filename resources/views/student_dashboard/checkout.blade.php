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
      <h5 class="text-ims-orange">OFFICIAL INVOICE</h5>
      <h6 class="text-ims-default" style="text-transform: uppercase">INVOICE NO: {{ $receipt_no }} &nbsp;&nbsp;&nbsp;RECEIPT DATE: {{ $receipt_date }}</h6>
      <h6 class="text-ims-default">FAMILY NAME: {{ $family_name }} &nbsp;&nbsp;&nbsp;ADDRESS: {{ $family_address }}</h6>
      <table class="table table-bordered table-stripped" id="result-table">
        <thead>
          <tr class="text-ims-default">
            {{-- <th>S/N</th> --}}
            <th>STUDENT NAME</th>
            <th>FAMILY NAME</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($students_data as $item)
                <tr>
                    <td>{{ $item->fname }}</td>
                    <td>{{ $family_name }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <div class="row">
        <form action="#" method="POST" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="amount_to_pay">Total Due Amount in &#8358;</label>
                    <input type="text" name="amount_to_pay" id="amount_to_pay" placeholder="Amount to pay" value="{{ $total_due_amount }}">
                </div>
                <div class="col-md-12">
                    <label for="amount_to_paid">Amount Paid &#8358;</label>
                    <input type="text" name="amount_to_paid" id="amount_to_paid" placeholder="Amount Paid">
                </div>
                <div class="col-md-12 text-center print-btn">
                    <button class="btn btn-ims-green" id="checkout-btn" type="submit">
                       <i class="fa fa-shopping-cart"></i>&nbsp; CHECKOUT
                    </button>
               </div>
            </div>
        </form>
        {{-- <div class="col-md-12 text-center">
            <h6>TOTAL DUE AMOUNT:&nbsp;&#8358;{{ $total_due_amount }}</h6>
        </div> --}}
        {{-- <div class="col-md-6">
            <h6 class="text-dark">
                <b>SIGNATURE:</b>&nbsp; <span class="text-ims-default">________________</span>
            </h6>
        </div>
        <div class="col-md-6">
            <h6 class="text-dark">
                <b>DATE:</b>&nbsp;<span class="text-ims-default">{{ date('D/M/Y') }}</span>
            </h6>
        </div> --}}
      </div>
    </div>
</div>
<script>

    // function printReceipt(el){
    //     var restorepage = $('body').html();
    //     var printcontent = $('#' + el).clone();
    //     $('body').empty().html(printcontent);
    //     window.print();
    //     $('body').html(restorepage);
    // }
    // upload book ajax 
    $('#checkout-form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#checkout-btn').text('Please wait....');
            $.ajax({
                url: '{{ route('portal.checkout.final') }}',
                method: 'post',
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    if (res.status == 200) {
                        // const paymentForm = document.getElementById('paymentForm');
                        // paymentForm.addEventListener("submit", payWithPaystack, false);
                        // e.preventDefault();
                        let handler = PaystackPop.setup({
                            key: 'pk_test_3127085c64c044656508663468ff3eaa942c00e7', // Replace with your public key
                            email: res.email,
                            amount: res.data.amount_paid * 100,
                            currency: 'NGN',
                            ref: res.data.invoice_no, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

                            // label: "Optional string that replaces customer email"
                            onClose: function(){
                                $.ajax({
                                    url: '{{ route('portal.checkout') }}',
                                    method: 'get',
                                    success: function (response) {
                                        // the transaction status is in response.data.status
                                        Swal.fire(
                                            'Payment!',
                                            'Has been cancelled',
                                            'warning'
                                        );
                                    }

                                });
                            },
                            callback: function(response){
                                $.ajax({
                                    url: '{{ route('portal.finance') }}',
                                    method: 'get',
                                    success: function (response) {
                                        console.log(response);
                                        // the transaction status is in response.data.status
                                        Swal.fire(
                                            'Payment complete!',
                                            'Reference: ' + response.data.reference,
                                            'success'
                                        );
                                    }

                                });
                            }

                        });
                        handler.openIframe();
                    }
                }
            })
        })

</script>
@endsection