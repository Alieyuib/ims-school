@extends('layouts.app_teacher')

@section('content')
    <div class="row">
        <div class="col-md-12 header-dashboard"></div>
        <div class="col-md-4 card user-info">
            <img src="{{asset('images/logo.jpg')}}" alt="">
            <h4 class="text-ims-default">{{ $loggedInTeacher }}</h4>
            <h5 class="text-ims-orange">{{ $loggedInSubject }}</h5>
        </div>
        <div class="col-md-12 footer-dashboard">
            <div class="col-md-6 footer-text">
                <h5 class="text-light">
                © {{ date('Y') }} The Priority School All rights reserved.
                </h5>
            </div>
        </div>
    </div>
@endsection