@extends('layouts.app_front')

@section('title', 'The Priority School')
    
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 header-ims shadow">
                <div class="row">
                    <div class="col-md-6 logo-header">
                        <img src="{{ asset('images/logo.jpg') }}" alt="">
                        <h3>The Priority School</h3>
                    </div>
                    <div class="col-md-6 links-header">
                        <ul class="">
                            <li class="list-group-item">
                                <a href="#home">HOME</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#about">ABOUT US</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#registration">ONLINE REGISTRATION</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('portal.index') }}">STUDENT PORTAL</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 hero-slider" id="home">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('app-assets/img/loginhero.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('app-assets/img/loginhero.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('app-assets/img/loginhero.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 about-section" id="about">

            </div>
        </div>
    </div>
@endsection

@section('script')
   <script>
       
   </script>
@endsection