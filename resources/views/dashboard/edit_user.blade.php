@extends('layouts.app')

@section('content')

<form action="/dashboard/user/edit/{{$uid}}" method="POST" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-ims-default">Edit user {{ $name }}</h6>
            @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        </div>
    </div>
    @csrf
    <div class="row p-4">
        <div class="form-group col-md-12">
            <label for="fname">Fullname</label>
            <input type="text" class="form-control" name="fname" placeholder="Fullname" value="{{$name}}" id="fname">
        </div>
        {{-- <div class="form-group col-md-12">
            <label for="phone_no">Phone Number</label>
            <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" id="phone_no">
        </div> --}}
        <div class="form-group col-md-12">
            <label for="email">Email <Address></Address></label>
            <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{$email}}" id="email">
        </div>
        <div class="form-group col-md-12">
            <label for="pword">Password</label>
            <input type="text" class="form-control" name="password" placeholder="leave empty to remain unchanged" id="pword">
        </div>
        {{-- <div class="form-group col-md-12">
            <label for="cpword">Confirm Password</label>
            <input type="text" class="form-control" name="cpword" placeholder="Confirm Password" id="cpword">
        </div> --}}
        <div class="form-group col-md-12 text-center">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Update <i class="fa fa-bookmark-o"></i></button>
            <a href="/dashboard/user/edit-user-access/{{$uid}}" class="btn btn-ims-orange my-2" id="save-btn">Edit Access <i class="fa fa-lock"></i></a>
        </div>
    </div>
</form>
<script>
    

</script>
@endsection