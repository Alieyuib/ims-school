@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-1">
      <div class="col-lg-12 student-list-div">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Generate Invoice(تسجيل جميع الطلاب)</h3>
          </div>
            @if (session()->has('status'))
                <div class="alert alert-success my-2">
                    {{  session('status') }}
                </div>
            @endif
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
                url: '{{ route('dashboard.logs.generate') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        $(document).on('click', '.generateIcon', function(e){
            e.preventDefault();
            let id  = $(this).attr('id');
            $.ajax({
                url: '{{ route('get.invoice.data') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Invoice',
                            'Generated',
                            'success'
                        );
                        // fetchAllTransactions();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Invoice',
                            'Generated',
                            'error'
                        );
                    }
                }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

