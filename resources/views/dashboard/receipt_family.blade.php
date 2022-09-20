@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-1">
      <div class="col-lg-12" id="invoice">
        <div class="card shadow student-list-div-default">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Generate Family Receipt</h3>
            @if (session()->has('status'))
              <div class="alert alert-success my-2">
                  {{  session('status') }}
              </div>
            @endif
          </div>
          <div class="card-body bg-orange text-center" id="show_all_students">
            <table class="table table-bordered table-striped align-middle table-hover mx-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Account Name</th>
                        <th>Email Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student_data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->account_name }}</td>
                            <td>{{ $item->email }}</td>  
                            <td>
                                <a href="/dashboard/receipt/family/{{$item->id}}" class="btn btn-success">Generate</a>
                            </td>
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
        
        function printReceipt(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
        }

        $('#print_btn').on("click", function(el){
            printReceipt('invoice')
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

