@extends('layouts.login_app')

@section('title', 'Register')
    
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-3 card shadow bg-light p-20 text-center rounded-0" style="padding: 20px;">
                <h5 class="text-secondary">The Priority School</h5>
                <div class="card-body">
                    <div id="show_success_message"></div>
                    <form action="" method="POST" id="register_form">
                        @csrf
                        <div class="mb-3">
                            <input type="test" name="fname" id="fname" class="form-control rounded-0" placeholder="Fullname">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="Email Address">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" value="Register" class="btn btn-primary rounded-0" id="register_btn">
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account?</a>
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
            $('#register_form').submit(function(e){
                e.preventDefault();
                const fd  = new FormData(this);
                $('#register_btn').val('Please Wait....');
                $.ajax({
                    url: '{{ route('auth.register') }}',
                    method: 'post',
                    data: fd,
                    dataType:'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        // alert(res);
                        if (res.status == 400) {
                            showError('fname', res.msg.fname);
                            showError('email', res.msg.email);
                            showError('password', res.msg.password);
                            showError('cpassword', res.msg.cpassword);
                            $('#register_btn').val('Register');
                        }else if (res.status == 200) {
                            showMessage('success', res.msg);
                            $('#register_form')[0].reset();
                            removeValidClasses('#register_form');
                            $('#register_btn').val('Register');
                        } 
                    }
                })
            })
        })
    </script>
@endsection