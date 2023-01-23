@extends('layouts.app')

@section('content')
<div class="modal fade" id="uploadBookModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Book <i class="fa fa-book"></i></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="upload-book-form col-md-12" enctype="multipart/form-data" method="POST" id="upload_book_form">
                @csrf
                {{-- <i class="fa fa-book fa-5x text-ims-default form-icon"> --}}
                </i>
                {{-- <h3 class="text-ims-default">Add New Book</h3> --}}
                <h6 class="text-ims-orange">PDF FORMATs ONLY</h6>
                <div class="row">
                    <div class="col-md-12">
                        <label for="book_name">Book Name</label>
                        <input type="text" id="book_name" name="book_name" class="form-control" placeholder="Book name">
                    </div>
                    <div class="col-md-12">
                        <label for="book_file">Select Book</label>
                        <input type="file" id="book_file" class="form-control" name="book_file">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-ims-orange" id="upload-book">
                            <i class="fa fa-upload"></i>&nbsp; Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit student modal end --}}
    <div class="card shadow student-list-div-main">
        <div class="">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-ims-default">All Uploaded Books(تسجيل جميع الطلاب)</h3>
            <button class="btn btn-ims-green" data-bs-toggle="modal" data-bs-target="#uploadBookModal">
                Upload New Book <i class="fa fa-upload"></i>
            </button>
        </div>
        <div class="bg-orange" id="show_all_students">
            <h1 class="text-center text-secondary my-5">
                <img src="{{asset('images/Hourglass.gif')}}" alt="" srcset="">
            </h1>
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
                url: '{{ route('dashboard.all.books') }}',
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

