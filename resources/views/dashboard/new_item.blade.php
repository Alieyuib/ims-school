@extends('layouts.app')

@section('content')

<form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-ims-default">Add Product</h6>
        </div>
    </div>
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label for="item_name">Prpduct Name</label>
            <input type="text" class="form-control" name="item_name" placeholder="Item Name" id="item_name">
        </div>
        <div class="form-group col-md-12">
            <label for="item_price">Product Price</label>
            <input type="number" class="form-control" name="item_price" placeholder="Item Price" id="item_price">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Add <i class="fa fa-plus-square"></i></button>
        </div>
    </div>
</form>
<script>
    $('#grade_student_form').submit(function(e){
        e.preventDefault();
        // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        const fd = new FormData(this);
        if (        
        $('#item_name').val() == '' ||            
        $('#item_price').val() == ''         
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Adding item...');
        $.ajax({
            url: '{{ route('dashboard.add.item') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status == 200) {
                    Swal.fire(
                        'Item',
                        'Added Sucessfully',
                        'success'
                    );
                    $('#grade_student_form').trigger('reset');
                    $('#save-btn').text('Add');
                }else if (res.status == 300) {
                    Swal.fire(
                        'Item',
                        'Not Added Sucessfully',
                        'error'
                    )
                } 
            }
        });
    }
        
    });
</script>
@endsection