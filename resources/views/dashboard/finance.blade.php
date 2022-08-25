@extends('layouts.app')

@section('content')
{{-- <body class="bg-dark"> --}}
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Account Balance</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="account_balance_form" enctype="multipart/form-data" class="reg-modal-form">
            @csrf
            {{-- <input type="hidden" name="student_id" id="student_id"> --}}
            {{-- <input type="hidden" name="student_passport" id="student_passport"> --}}
            <div class="modal-body p-4 bg-light">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="class_admitted">Account Balance</label>
                        <input type="number" class="form-control" id="account_balance" name="account_balance" placeholder="Account Balance">
                        <input type="hidden" class="form-control" id="account_email" name="account_email">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="edit_student_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        </div>
    </div>
<div class="container">
    <div class="row my-1">
      <div class="col-lg-12 student-list-div">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">All Accounts(تسجيل جميع الطلاب)</h3>
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
                url: '{{ route('dashboard.logs') }}',
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
                url: '{{ route('dashboard.edit.account') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    $('#account_balance').val(res.balance);
                    $('#account_email').val(res.email);
                }
            })
        })

        // update employee ajax 
        $('#account_balance_form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#edit_student_btn').text('Saving....');
            $.ajax({
                url: '{{ route('dashboard.edit.account.balance') }}',
                method: 'post',
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Success',
                            '',
                            'success'
                        );
                        $('#account_balance_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#edit_student_btn').text('Save');
                        fetchAllTransactions();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Error',
                            '',
                            'error'
                        );
                        $('#edit_student_btn').text('Save');
                    } 
                }
            })
        })

        
    </script>
@endsection
{{-- </body>
</html> --}}

