@extends('layouts.app')

@section('content')
<div class="card shadow student-list-div-main">
    <h3 class="text-ims-default">Recent Invoice</h3>
    <div class="bg-orange" id="show_all_students">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Invoice ID</th>
                    <th>Invoice</th>
                    <th>To</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recent_invoice as $item)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $item->invoice_id }}</td>
                        <td><a href="../../../storage/invoice/{{ $item->invoice }}">{{ $item->invoice }}</a></td>
                        <td>{{ $item->student_email }}</td>
                        <td>{{ $item->created_at }}</td>
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
