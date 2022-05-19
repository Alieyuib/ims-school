@extends('layouts.app')

@section('content')
    <div class="main-div">
        <div class="container">
            <div class="row">
                <div class="col-md-4 card main-login">
                    <div class="login-header">
                        <p class="header">
                            <strong>IMS</strong>
                            <span>School</span>
                        </p>
                    </div>
                    <form action="/" method="POST" class="login-form col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user fa-1x"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="username">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-lock fa-1x"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" id="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-login" id="loginBtn">
                                    <i class="fa fa-unlock fa-1x"></i>
                                </button>
                            </div>
                            <div class="col-md-12 forget-password-div">
                                <p class="forget-password-text">
                                    <a href="" class="link">forget password</a> <i class="fa fa-question"></i>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection