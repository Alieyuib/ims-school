@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 card new-book-div">
        <div class="col-lg-12">
            <div class="shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">All Invoice(تسجيل جميع الطلاب)</h3>
                {{-- <button class="btn btn-ims-green" data-bs-toggle="modal" data-bs-target="#uploadBookModal">
                    Upload New Book <i class="fa fa-upload"></i>
                </button> --}}
            </div>
            <div class="card-body bg-orange" id="show_all_students">
                <h1 class="text-center text-secondary my-5">
                    <img src="{{asset('images/Hourglass.gif')}}" alt="" srcset="">
                </h1>
            </div>
            </div>
        </div>
    </div>
</div>
    <script>
        // Fetch All Employee
        setTimeout(() => {
            fetchAllTransactions();
        },2500);

        function fetchAllTransactions() {
            $.ajax({
                url: '{{ route('dashboard.logs.edit') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        $(document).on('click', '.confirmIcon', function(e){
            e.preventDefault();
            let id  = $(this).attr('id');
            $.ajax({
                url: '{{ route('dashboard.confirm.transaction') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    if (res.status == 200) {
                        Swal.fire(
                            'Transaction Confirm Successfully',
                            'Invoice No: ' + res.invoice_no + '   '+ 'Transaction ID: ' + res.transaction_id,
                            'success'
                        );
                        fetchAllTransactions();
                    }
                    if (res.status == 300) {
                        Swal.fire(
                            'Transaction Confirm',
                            'Error',
                            'error'
                        );
                        fetchAllTransactions();
                    }
                }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

