@extends('layouts.app_student')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 dashboard-card card" id="balance_div">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-money fa-3x text-primary"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    BALANCE <br>
                                    (الرصيد)
                                </p>
                                <p class="number-total">
                                    <span><b>&#8358;{{ $balance }}</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card" id="class_div">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-graduation-cap fa-3x text-danger"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    CLASS <br>
                                    (صف دراسي)
                                </p>
                                <p class="number-total">
                                    <span><b>{{ $current_class }}</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card" id="subject_div">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-book fa-3x text-warning"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    BOOKS <br>
                                    (المواضيع)
                                </p>
                                <p class="number-total">
                                    <span><b>4</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card" id="members_div">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-users fa-3x text-success"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    MEMBERS <br>
                                    (أفراد)
                                </p>
                                <p class="number-total">
                                    <span><b>{{ $member_count }}</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
       $(document).on('click', '#balance_div', function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('portal.transaction.history') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    Toast.fire({
                        icon: "info",
                        title: "Please wait....",
                    });
                    setTimeout(() => {
                        window.location = '{{ route('portal.transaction.history') }}';
                    }, 1000);
                    // console.log(res);
                }
        })
       })

       $(document).on('click', '#subject_div', function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('portal.subject.records') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    Toast.fire({
                        icon: "info",
                        title: "Please wait....",
                    });
                    setTimeout(() => {
                        window.location = '{{ route('portal.subject.records') }}';
                    }, 1000);
                    // console.log(res);
                }
        })
       })
   </script>
@endsection