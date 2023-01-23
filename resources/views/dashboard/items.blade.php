@extends('layouts.app')

@section('content')
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product <i class="fa fa-list"></i></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="upload-book-form col-md-12" enctype="multipart/form-data" method="POST" id="edit_product_form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="item_name">Product Name</label>
                        <input type="hidden" name="item_id" id="item_id">
                        <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Product Name">
                    </div>
                    <div class="col-md-12">
                        <label for="item_price">Product Price</label>
                        <input type="text" id="item_price" class="form-control" name="item_price" placeholder="Product Price">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="item_type">Item Type</label>
                        <select name="item_type" id="item_type" class="form-control">
                            <option value="" selected disabled>Type</option>
                            <option value="fees">Fee</option>
                            <option value="uniform">Uniform</option>
                            <option value="stationary">Stationary</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-ims-orange" id="upload-book">
                            <i class="fa fa-upload"></i>&nbsp; Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit student modal end --}}
    <div class="card shadow student-list-div-main mx-3">
        <h3 class="text-ims-default">All System Products</h3>
        <div class="bg-orange" id="show_all_students">
            <h1 class="text-center text-secondary my-5">
                <img src="{{asset('images/Hourglass.gif')}}" alt="" srcset="">
            </h1>
        </div>
    </div>
    <script>
        // Fetch All Employee
        setTimeout(() => {
            fetchAllItem();
        },2500);
        function fetchAllItem() {
            $.ajax({
                url: '{{ route('dashboard.item.list') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }
        // update ajax 
        $('#edit_product_form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#upload-book').text('Saving....');
            $.ajax({
                url: '{{ route('dashboard.update.item') }}',
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
                            'Item',
                            'Data Updated Successfully',
                            'success'
                        );
                        $('#edit_product_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#upload-book').text('Update');
                        fetchAllItem();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Item',
                            'Data Not Updated',
                            'error'
                        );
                        $('#edit_product_form').text('Save');
                    } 
                }
            })
        })

        // edit data ajax
        $(document).on('click', '.editIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('dashboard.edit.item') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    $('#item_price').val(res.item_price);
                    $('#item_name').val(res.item_name);
                    $('#item_type').val(res.type);
                    $('#item_id').val(res.id);
                }
            })

        })



        // delete data 
        $(document).on('click', '.deleteIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('dashboard.delete.item') }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res){
                       console.log(res);
                       Swal.fire(
                           'Deleted',
                           'Item Data',
                           'success'
                       )  
                       fetchAllItem();
                    }
                })
            }
            })
        })
        
    </script>
    </script>
@endsection
{{-- </body>
</html> --}}

