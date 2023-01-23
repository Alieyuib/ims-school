@extends('layouts.app')

@section('content')
        <div class="card shadow student-list-div-main">
            <h3 class="text-ims-default">Gallery Images (تسجيل جميع الطلاب)</h3>
            @if (session()->has('status'))
                <div class="alert alert-info my-2">
                    {{  session('status') }}
                </div>
            @endif
            <div id="show_all_students">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-ims-default">
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
    <script>
        $('table').DataTable({
            order: [0, 'asc'],
            scrollY: true,
        });
    </script>
@endsection
{{-- </body>
</html> --}}

