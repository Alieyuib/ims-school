@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 dashboard-card card">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-users fa-3x text-primary"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    Active Students <br>
                                    (الطلاب النشطاء)
                                </p>
                                <p class="number-total">
                                    <span>100</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-male fa-3x text-ims-default"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    Adult Students <br>
                                    (الطلاب الكبار)
                                </p>
                                <p class="number-total">
                                    <span>70</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-user-times fa-3x text-danger"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                    Inactive Students <br>
                                    (الطلاب غير النشطين)
                                </p>
                                <p class="number-total">
                                    <span>50</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 dashboard-card card">
                        <div class="row">
                            <div class="col-md-4 card-icon">
                                <i class="fa fa-briefcase fa-3x text-warning"></i>
                            </div>
                            <div class="col-md-8 card-text">
                                <p class="number-text">
                                     Staffs <br>
                                     (طاقم العمل)
                                </p>
                                <p class="number-total">
                                    <span>30</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection