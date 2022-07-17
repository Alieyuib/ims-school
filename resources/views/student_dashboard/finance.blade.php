@extends('layouts.app_student')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row finance_div">
                    <div class="col-md-5 dashboard-card card bg-success" id="print_fee_schedule">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-print fa-4x text-light"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-light">
                                    Print Fee Schedule
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card" id="payment_online">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-credit-card-alt fa-4x text-success"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-success">
                                    Payment&nbsp;<span>Online</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card bg-light" id="payment_bank">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-bank fa-4x text-success"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-success">
                                    Payment&nbsp;<span>Bank</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 dashboard-card card bg-success" id="payment_history">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-money fa-4x text-light"></i>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="text-light">
                                    Transaction History
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <body class="bg-dark"> --}}
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modal-color">
        <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">Fee Schecule For <span id="student-name" style="text-transform: uppercase">{{ $loggedInFamilyName }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
    </div>
</div>
{{-- edit student modal end --}}
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

</script>
@endsection