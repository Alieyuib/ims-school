@extends('layouts.app_student')

@section('content')
<div class="container">
    <div class="row my-1">
      <div class="col-lg-6 student-list-div">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Invoice</h3>
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

    setTimeout(() => {
            fetchAllInvoice();
        },2500);

    function fetchAllInvoice() {
        $.ajax({
            url: '{{ route('portal.transaction.invoice') }}',
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

