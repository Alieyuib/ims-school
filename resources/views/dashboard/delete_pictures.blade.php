@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-1">
        <div class="col-md-12 student-list-div-main">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-success">Gallery Images (تسجيل جميع الطلاب)</h3>
                @if (session()->has('status'))
                    <div class="alert alert-info my-2">
                        {{  session('status') }}
                    </div>
                @endif
            </div>
            <div id="show_all_students">
                <table class="table table-bordered table-striped align-middle table-hover mx-1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Images</th>
                            <th>Caption</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="../../storage/gallery/{{$item->img_file}}" width="50" height="50" class="img-thumbnail" />
                                </td>
                                <td>{{ $item->caption_img }}</td>
                                <td>
                                    <a href="/dashboard/delete/picture/{{$item->id}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <script>
        $('table').DataTable({
            order: [0, 'asc'],
            scrollY: true,
        });
    </script>
@endsection
{{-- </body>
</html> --}}

