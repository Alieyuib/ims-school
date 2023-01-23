@extends('layouts.app')

@section('content')
        <div class="card shadow student-list-div-main">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-ims-default">Generate ID Card For Students(تسجيل جميع الطلاب)</h3>
            </div>
            <div id="show_all_students">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-ims-default">
                            <th>ID</th>
                            <th>Passport</th>
                            <th>Student Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="../storage/images/{{$item->passport}}" width="50" class="img-thumbnail rounded-circle" />
                                </td>
                                <td>{{ $item->name }}</td>
                                @if ($item->passport == '')
                                    <td>
                                        <h6 class="text-danger">No Passport Available</h6>
                                    </td>
                                @else
                                    <td>
                                        <a href="/students/idcard/{{$item->id}}" class="btn btn-ims-green">Generate</a>
                                    </td>
                                @endif
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

