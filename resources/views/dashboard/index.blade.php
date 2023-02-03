@extends('layouts.app')

<style>
    @media only screen and (max-width: 768px) {
    .background-img{
        display: none;
    }
    .dashboard-card{
        /* margin: 0px; */
        margin-left: 0px !important;    
        margin-bottom: 20px;
        /* height: 60px !important; */
    }
    /* .dashbaord-main{
        max-height: 100vh;
        /* overflow-y: scroll; */
    } */
}
</style>

@section('content')
    @role('super_admin')
        <div class="row dashbaord-main">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img">
            <div class="col-sm-3 dashboard-card card">
                <div class="row">
                    <div class="col-sm-4 card-icon">
                        <i class="fa fa-users fa-3x text-primary"></i>
                    </div>
                    <div class="col-sm-8 card-text">
                        <p class="number-text">
                            Active Students <br>
                            (الطلاب النشطاء)
                        </p>
                        <p class="number-total">
                            <span><b>{{ $total_students }}</b></span>
                        </p>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-3 dashboard-card card">
                <div class="row">
                    <div class="col-sm-4 card-icon">
                        <i class="fa fa-male fa-3x text-ims-default"></i>
                    </div>
                    <div class="col-sm-8 card-text">
                        <p class="number-text">
                            Adult Students <br>
                            (الطلاب الكبار)
                        </p>
                        <p class="number-total">
                            <span>{{ $total_student_adult }}</span>
                        </p>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-sm-3 dashboard-card card">
                <div class="row">
                    <div class="col-sm-4 card-icon">
                        <i class="fa fa-user-times fa-3x text-danger"></i>
                    </div>
                    <div class="col-sm-8 card-text">
                        <p class="number-text">
                            Inactive Students <br>
                            (الطلاب غير النشطين)
                        </p>
                        <p class="number-total">
                            <span>50</span>
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="col-sm-3 dashboard-card card">
                <div class="row">
                    <div class="col-sm-4 card-icon">
                        <i class="fa fa-briefcase fa-3x text-warning"></i>
                    </div>
                    <div class="col-sm-8 card-text">
                        <p class="number-text">
                            Staffs <br>
                            (طاقم العمل)
                        </p>
                        <p class="number-total">
                            <span><b>{{ $total_users }}</b></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 dashboard-card card">
                <div class="row">
                    <div class="col-sm-4 card-icon">
                        <i class="fa fa-money fa-3x text-success"></i>
                    </div>
                    <div class="col-sm-8 card-text">
                        <p class="number-text">
                            Accounts <br>
                            (طاقم العمل)
                        </p>
                        <p class="number-total">
                            <span><b>{{ $total_account }}</b></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-12 header-dashboard"></div>
            <div class="col-sm-4 card user-info">
                <img src="{{asset('images/logo.jpg')}}" alt="">
                <h4 class="text-ims-default">{{ $userLoggedIn }}</h4>
                <h5 class="text-ims-orange"></h5>
            </div>
            <div class="col-sm-12 footer-dashboard">
                <div class="col-sm-6 footer-text">
                    <h5 class="text-light">
                    © {{ date('Y') }} The Priority School All rights reserved.
                    </h5>
                </div>
            </div>
        </div>
    @endrole
@endsection