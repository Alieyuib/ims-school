@extends('layouts.app_student')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-finance">
            <div class="container">
                <div class="row finance_div">
                    <div class="col-md-5 dashboard-card card" id="print_fee_schedule">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-print fa-4x text-ims-default"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-ims-default">
                                    Print Fee Schedule
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card" id="payment_online">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-credit-card-alt fa-4x text-ims-default"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-ims-default">
                                    Payment&nbsp;<span>Online</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card" id="payment_bank">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-bank fa-4x text-ims-default"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-ims-default">
                                    Payment&nbsp;<span>Bank</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card" id="payment_history">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-money fa-4x text-ims-default"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-ims-default">
                                    Transaction History
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>

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
                    window.location = '{{ route('portal.receipt') }}';
                }
            })

        })

    $(document).on('click', '#payment_online', function(e){
        e.preventDefault();
        $.ajax({
                url: '{{ route('portal.checkout') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    window.location = '{{ route('portal.checkout') }}';
                    // console.log(res);
                }
            })
    })

    $(document).on('click', '#payment_history', function(e){
        e.preventDefault();
        $.ajax({
                url: '{{ route('portal.transaction.history') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    window.location = '{{ route('portal.transaction.history') }}';
                    // console.log(res);
                }
            })
    })

    

</script>
@endsection