@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-1">
        <div class="col-md-12 card shadow  student-list-div-main">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">Arrauda Ath-thaaniya Students(تسجيل جميع الطلاب)</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover mx-1" border="2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Passport</th>
                            <th>Student Name</th>
                            {{-- <th>Action</th> --}}
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
                                {{-- @if ($item->passport == '')
                                    <td>
                                        <h6 class="text-danger">No Passport Available</h6>
                                    </td>
                                @else
                                    <td>
                                        <a href="/students/idcard/{{$item->id}}" class="btn btn-success">Generate</a>
                                    </td>
                                @endif --}}
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

