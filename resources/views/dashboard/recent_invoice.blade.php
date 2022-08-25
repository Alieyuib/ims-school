@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 card new-book-div">
        <div class="col-lg-12">
            <div class="shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">Recent Invoice(تسجيل جميع الطلاب)</h3>
            </div>
            <div class="card-body bg-orange" id="show_all_students">
                <table class="table table-bordered mx-1">
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Invoice</th>
                            <th>To</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent_invoice as $item)
                            <tr>
                                <td>{{ $item->invoice_id }}</td>
                                <td><a href="../../storage/{{ $item->invoice }}">{{ $item->invoice }}</a></td>
                                <td>{{ $item->student_email }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
    <script>
       
        
    </script>
@endsection
{{-- </body>
</html> --}}

