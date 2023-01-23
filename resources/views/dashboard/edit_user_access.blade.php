@extends('layouts.app')

@section('content')
        <form action="/dashboard/user/assign-user-access/{{$uid}}" method="POST" enctype="multipart/form-data" class="p-4 grading-container grade-form card shadow"> 
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
                    <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
                    <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
                    <h6 class="text-ims-default">Edit user Access : {{ $name }}</h6>
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @csrf
            <div class="row">
                <p> switch on or off roles you want to assign to this user</p>
                <div class="form-group col-md-12">
                    @if (session()->has('status'))
                        <div class="alert alert-success my-2">
                            {{  session('status') }}
                        </div>
                    @endif
                    <table class="table-bordered table table-striped align-middle table-hover">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles_list as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    @if ($user->hasRole($role->id))
                                        <td>
                                            <input name="roles[]" value='{{$role->id}}' checked type="checkbox">
                                        </td>
                                    @else
                                        <td>
                                            <input name="roles[]" value='{{$role->id}}' type="checkbox">    
                                        </td>    
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Update <i class="fa fa-bookmark-o"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        
        {{-- <form action="/dashboard/user/assign-user-entities/{{$uid}}" method="POST" enctype="multipart/form-data" class="col-md-12"> 
            @csrf
            <div class="row">
                <p> Give access to only specific classes</p>
                <div class="form-group col-md-12">
                    @if (session()->has('status'))
                        <div class="alert alert-success my-2">
                            {{  session('status') }}
                        </div>
                    @endif
                    <table class="table-bordered table table-striped align-middle table-hover">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $class->class_name }}</td>
                                    @if ($user->canAccessClass($class->id))
                                        <td>
                                            <input name="school_classes[]" value='{{$class->class_name}}' checked type="checkbox">
                                        </td>
                                    @else
                                        <td>
                                            <input name="school_classes[]" value='{{$class->class_name}}' type="checkbox">    
                                        </td>    
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Update <i class="fa fa-bookmark-o"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form> --}}


<script>
    

</script>
@endsection