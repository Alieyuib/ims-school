@extends('layouts.login_app')

@section('title', 'Login')
    
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-3 card shadow bg-light p-20 text-center rounded-0" style="padding: 20px;">
                <h5 class="text-secondary">The Priority School</h5>
                <div class="card-body">
                    <form action="" method="POST" id="login_form">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="Email Address">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('forgot') }}" class="text-decoration-none">Forgot Password?</a>
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" value="Login" class="btn btn-success rounded-0" id="login_btn">
                        </div>
                        <div class="mb-3 text-secondary">
                            Dont have an account?&nbsp;<a href="{{ route('register') }}" class="text-decoration-none">Register here.</a>
                        </div>
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
                   url: '{{ route('auth.login') }}',
                   method: 'post',
                   data: fd,
                   dataType:'json',
                   cache: false,
                   processData: false,
                   contentType: false,
                   success: function(res){
                       if (res.status == 400) {
                           showError('email', res.msg.email);
                           showError('password', res.msg.password);
                           $('#login_btn').val('Login');
                       }else if (res.status == 401) {
                           showMessage(res.icon, res.msg);
                           $('#login_btn').val('Login');
                       } else {
                           if (res.status == 200 && res.msg == 'success') {
                               showMessage(res.msg, res.msg2);
                               setTimeout(() => {
                                   window.location = '{{ route('dashboard') }}'
                               }, 3000);
                           }
                       }
                   }
               })
           })
       })
   </script>
@endsection