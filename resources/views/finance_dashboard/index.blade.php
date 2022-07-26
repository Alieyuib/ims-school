@extends('layouts.login_app')

@section('title', 'Login')
    
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-3 card shadow admin-login p-20 text-center rounded-0" style="padding: 20px;">
                <img src="{{ asset('images/logo.jpg') }}" alt="" class="login-logo">
                <h3 class="text-ims-orange">The Priority School</h3>
                {{-- <h5 class="text-ims-orange">Student Portal</h5> --}}
                <div class="card-body">
                    <form action="" method="POST" id="login_form">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="Email Address">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="token" id="token" class="form-control rounded-0" placeholder="Token">
                            <div class="invalid-feedback"></div>
                        </div>
                        {{-- <div class="mb-3">
                            <a href="{{ route('forgot') }}" class="text-decoration-none text-success">Forgot Password?</a>
                        </div> --}}
                        <div class="mb-3 d-grid">
                            <input type="submit" value="Login" class="btn ims-bg-green rounded-0" id="login_btn">
                        </div>
                        {{-- <div class="mb-3 text-light">
                            Dont have an account?&nbsp;<a href="{{ route('register') }}" class="text-decoration-none text-success">Register here.</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
   <script>
       $(function(){
           $('#login_form').submit(function(e){
               e.preventDefault();
               const fd  = new FormData(this);
               $('#login_btn').val('Please Wait...');
               $.ajax({
                   url: '{{ route('portal.login') }}',
                   method: 'post',
                   data: fd,
                   dataType:'json',
                   cache: false,
                   processData: false,
                   contentType: false,
                   success: function(res){
                       if (res.status == 400) {
                           showError('email', res.msg.email);
                           showError('token', res.msg.password);
                           $('#login_btn').val('Login');
                       }else if (res.status == 401) {
                           showMessage(res.icon, res.msg);
                           $('#login_btn').val('Login');
                       } else {
                           if (res.status == 200 && res.msg == 'success') {
                               showMessage(res.msg, res.msg2);
                               setTimeout(() => {
                                   window.location = '{{ route('portal.dashboard') }}'
                               }, 1000);
                           }
                       }
                   }
               })
           })
       })
   </script>
@endsection