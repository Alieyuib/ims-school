@extends('layouts.app')

@section('content')
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign role to user</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" class="assign-role-form col-md-12" enctype="multipart/form-data" id="role-form">
            @csrf
            <input type="hidden" id="user_id" name="user_id">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="phone">Select Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Class 1">Class 1 Teacher</option>
                        <option value="Class 2">Class 2 Teacher</option>
                        <option value="Class 3">Class 3 Teacher</option>
                        <option value="Class 4">Class 4 Teacher</option>
                        <option value="Faslul Hifiz">Faslul Hifiz Teacher</option>
                        <option value="Arrauda Ath-thaaniya">Arrauda Ath-thaaniya Teacher</option>
                        <option value="Arraudatul Ola">Arraudatul Ola Teacher</option>
                        <option value="Hadaanah">Hadaanah Teacher</option>
                        <option value="Al-Quran">Al-Quran Teacher</option>
                        <option value="Al-Azkar">Al-Azkar Teacher</option>
                        <option value="Al-Huruf">Al-Huruf Teacher</option>
                        <option value="Al-Arabiyya">Al-Arabiyya Teacher</option>
                        <option value="Super Admin">Super Admin</option>
                        {{-- <option value="role 1"></option> --}}
                    </select>
                </div>
                {{-- <div class="col-md-12 form-group" id="class_role">
                    <label for="phone">Select Class</label>
                    <select name="role" id="class" class="form-control">
                        <option value="Class 1">Class 1</option>
                        <option value="Class 2">Class 2</option>
                        <option value="Class 3">Class 3</option>
                        <option value="Class 4">Class 4</option>
                        <option value="Faslul Hifiz">Faslul Hifiz</option>
                        <option value="Arrauda Ath-thaaniya">Arrauda Ath-thaaniya</option>
                        <option value="Arraudatul Ola">Arraudatul Ola</option>
                        <option value="Hadaanah">Hadaanah</option>
                        <option value="role 1"></option>
                    </select>
                </div>
                <div class="col-md-12 form-group" id="subject_role">
                    <label for="phone">Select Subject</label>
                    <select name="role" id="subject" class="form-control">
                        <option value="Al-Quran">Al-Quran</option>
                        <option value="Al-Azkar">Al-Azkar</option>
                        <option value="Al-Huruf">Al-Huruf</option>
                        <option value="Al-Arabiyya">Al-Arabiyya</option>
                        <option value="role 1"></option>
                    </select>
                </div> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="assign_btn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 card new-book-div">
        <div class="col-lg-12">
            <div class="shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">All System Users(تسجيل جميع الطلاب)</h3>
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
        $('#class_role').hide();
        $('#subject_role').hide()
        $(document).on('change', '#role', function(e){
            e.preventDefault();
            if ($('#role').val() == 'Class Teacher') {
                console.log($('#role').val());
                $('#class_role').show();
                $('#subject_role').hide()
            }

            if ($('#role').val() == 'Subject Teacher') {
                console.log($('#role').val());
                $('#subject_role').show()
                $('#class_role').hide();
            }

            if ($('#role').val() == 'Super Admin') {
                console.log($('#role').val());
                $('#class_role').hide();
                $('#subject_role').hide()
            }
        })
        // Fetch All Employee
        setTimeout(() => {
            fetchAllTransactions();
        },2500);

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

