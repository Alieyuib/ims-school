@extends('layouts.app_student')

@section('content')
<div class="row">
    <div class="col-md-12 card new-book-div">
        <div class="col-lg-12">
            <div class="shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-success">All Learning Books(تسجيل جميع الطلاب)</h3>
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
                url: '{{ route('portal.all.books') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        // upload book ajax 
        $('#upload_book_form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#upload-book').text('Uploading....');
            $.ajax({
                url: '{{ route('dashboard.upload.book') }}',
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
                            'Book',
                            'Uploaded Successfully',
                            'success'
                        );
                        $('#upload_book_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#upload-book').text('Upload');
                        fetchAllBooks();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Book',
                            'Not Uploaded',
                            'warning'
                        );
                        $('#upload-book').text('Upload');
                    } 
                }
            })
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

