@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 student-list-div-main">
        <div class="col-lg-12">
            <div class="">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-ims-default">Recent Receipt(تسجيل جميع الطلاب)</h3>
            </div>
            <div class="bg-orange" id="show_all_students">
                <table class="table table-bordered table-hover mx-1">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Receipt ID</th>
                            <th>Receipt</th>
                            <th>To</th>
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent_receipts as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->receipt_id }}</td>
                                <td><a href="../../storage/invoice/{{ $item->receipt }}">{{ $item->receipt }}</a></td>
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
    $('table').DataTable({
        order: [0, 'asc'],
        scrollY: true,
    });
</script>
@endsection
