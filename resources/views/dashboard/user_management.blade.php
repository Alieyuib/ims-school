@extends('layouts.app')

@section('content')
    <div class="card shadow student-list-div-main">
        @if (session()->has('status'))
            <div class="alert alert-success my-2">
                {{  session('status') }}
            </div>
        @endif
        <div class="">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-ims-default">All System Users(تسجيل جميع الطلاب)</h3>
        </div>
        <div class="bg-orange" id="">
            <table class="table table-hover">
                <thead>
                    <tr class="text-ims-default">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users_list as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->getRoleNames() as $role )
                                    {{$role}},
                                @endforeach
                            </td>
                            <td>
                                <a href="/dashboard/user/edit/{{$user->id}}" class="mx-2 btn btn-sm btn-ims-orange">Edit</a>
                                <a href="/dashboard/user/delete/{{$user->id}}" class="mx-2 btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <script>
        $('table').DataTable({
            order: [0, 'asc'],
            scrollY: true,
        });
        // Fetch All Employee
        // setTimeout(() => {
        //     fetchAllTransactions();
        // },2500);

        function fetchAllTransactions() {
            $.ajax({
                url: '{{ route('dashboard.get.all.users') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        $(document).on('click', '.assignIcon', function(e){
            e.preventDefault();
            let id  = $(this).attr('id');
            $.ajax({
                url: '{{ route('get.user.data') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    $('#user_id').val(res.id);
                }
            })
        })

        $('#role-form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#assign_btn').text('Saving....');
            $.ajax({
                url: '{{ route('user.data.update') }}',
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
                            'User',
                            'Role Assign Successfully',
                            'success'
                        );
                        // $('#role-form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#assign_btn').text('Save');
                        fetchAllTransactions();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'User',
                            'Role',
                            'error'
                        );
                        $('#assign_btn').text('Save');
                    } 
                }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

