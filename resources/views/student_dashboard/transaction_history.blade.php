@extends('layouts.app_student')

@section('content')
<div class="row">
    <div class="col-md-12 card new-book-div">
        <div class="col-lg-12">
            <div class="shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">Transaction History(تسجيل جميع الطلاب)</h3>
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
            fetchAllBooks();
        },2500);

        function fetchAllBooks() {
            $.ajax({
                url: '{{ route('portal.transaction.histories') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }
        
    </script>
@endsection
{{-- </body>
</html> --}}

