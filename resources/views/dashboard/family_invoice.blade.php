@extends('layouts.app')

@section('content')
<div class="card shadow student-list-div-main">
  <h3 class="text-ims-default">Generate Family Invoice <span class="text-ims-orange">(تسجيل جميع الطلاب)</span></h3>
  <div class="bg-orange" id="show_all_students">
      <table class="table table-hover">
          <thead>
            <tr class="text-ims-default">
                <th>ID</th>
                <th>Student Name</th>
                <th>Email Address</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($student_data as $item)
                  <tr>
                      <td>{{ $counter++ }}</td>
                      <td>{{ $item->name }}</td>
                      <td class="text-uppercase">{{ $item->email }}</td>  
                      <td>
                          <a href="/dashboard/family/profile/{{$item->email}}" class="btn btn-ims-green">View profile</a>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
{{-- <div class="container"> 
    <div class="row my-1">
      <div class="col-lg-12 student-list-div-main" id="invoice">
        <div class="">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-ims-default">Generate Family Invoice</h3>
            @if (session()->has('status'))
              <div class="alert alert-success my-2">
                  {{  session('status') }}
              </div>
            @endif
          </div>
          <div class="bg-orange" id="show_all_students">
            <table class="table table-bordered table-hover">
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
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>  
                            <td>
                                <a href="/dashboard/receipt/family/{{$item->id}}" class="btn btn-ims-green">Generate</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
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

