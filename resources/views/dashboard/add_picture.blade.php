@extends('layouts.app')

@section('content')
<form action="#" method="POST" id="upload_form" enctype="multipart/form-data" class="reg-form col-md-8">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
        </div>
    </div>
    @csrf
    <div class="">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="firstname">Image Caption</label>
                {{-- <input type="hidden" class="form-control" name="status" id="status" value="1"> --}}
                <input type="text" class="form-control" name="img_caption" placeholder="Image Caption" id="img_caption">
            </div>
            <div class="form-group col-md-4">
                <label for="passport">Image</label>
                <input type="file" name="upld_img" class="form-control" id="upld_img">
            </div>
            <div class="mt-2" id="img"></div>
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-ims-orange" data-bs-dismiss="modal">Close</button> --}}
        <button type="submit" id="upload_btn" class="btn btn-ims-green">Upload</button>
    </div>
    </form>
    <script>
        // Adding New student
        $('#upload_form').submit(function(e){
            e.preventDefault();
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            const fd = new FormData(this);
            if (
            $('#img_caption').val() == '' ||            
            $('#upld_img').val() == ''
            ) {
            Swal.fire(
                'All Form',
                'Input fields are require',
                'warning'
            )
        }else{

            $('#upload_btn').text('Uploading...');
            $.ajax({
                url: '{{ route('dashboard.add.picture') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            'Image',
                            'Uploaded',
                            'success'
                        );
                        // fetchAllEmployees();
                        $('#upload_form').trigger('reset');
                        $('#upload_btn').text('Upload');
                        // $('#addStudentModal').modal('hide');
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Image',
                            'Not Uploaded',
                            'error'
                        )
                    } 
                }
            });
        }
            
        });
    </script>
@endsection