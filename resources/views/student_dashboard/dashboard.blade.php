@extends('layouts.app_student')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 dashboard-card card">
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
                                    <span><b>0</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
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
                                    <span><b>CLASS 2</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-book fa-3x text-warning"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    SUBJECTS <br>
                                    (المواضيع)
                                </p>
                                <p class="number-total">
                                    <span><b>6</b></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
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
@endsection