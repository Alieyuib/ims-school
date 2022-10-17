@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-1">
        <div class="col-md-12 student-list-div-main">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-success">View Expenses (تسجيل جميع الطلاب)</h3>
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
                            <th>Name</th>
                            <th>Price</th>
                            <th>Data Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{$item->expenses_name}}
                                </td>
                                <td>&#8358;{{ number_format($item->expenses_price) }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->expenses_status == 1)
                                        <span class="text-success">Approved</span>
                                    @endif
                                    @if ($item->expenses_status == 3)
                                        <span class="text-danger">Declined</span>
                                    @endif
                                    @if ($item->expenses_status == 0)
                                        <span class="text-warning">Awaiting Approval</span> 
                                    @endif
                                </td>
                                <td>
                                    @if ($item->expenses_status == 0)
                                        <a href="/dashboard/approve/expense/{{$item->id}}" class="btn btn-ims-orange">Approved</a>
                                        <a href="/dashboard/decline/expense/{{$item->id}}" class="btn btn-ims-green">Declined</a>

                                    @else
                                        <span class="text-success">No Action</span>
                                    @endif
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

