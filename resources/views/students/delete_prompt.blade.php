@extends('layouts.app')


@section('content')
    <div class="col-md-6 delete-prompt card alert-danger">
        @foreach ($delete_data as $item)
        <div class="prompt-text col-md-12">
            <h5 class="text">
                <span>Are you sure you want to delete</span>
                <strong>{{ $item->fname . " " . $item->lname}}</strong>
            </h5>
            <h4>Family Name: {{ $item->ffname }}</h4>
                <form action="" method="POST">
                    <input type="hidden" name="sid" value="{{$item->id}}">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-lg btn-danger">Yes</button>
                        <button type="button" class="btn btn-lg btn-warning">No</button>
                    </div>
                </form>
        @endforeach
        </div>
    </div>
@endsection