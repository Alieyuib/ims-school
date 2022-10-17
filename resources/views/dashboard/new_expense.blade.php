@extends('layouts.app')

@section('content')

<form action="#" method="POST" id="expenses_form" enctype="multipart/form-data" class="col-md-8 grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-ims-default">Create Expense</h6>
        </div>
    </div>
    @csrf
    <div class="row">
        @if (session()->has('status'))
            <div class="alert alert-info my-2">
                {{  session('status') }}
            </div>
        @endif
        <div class="form-group col-md-12">
            <label for="item_name">Expense Name</label>
            <input type="text" class="form-control" name="expense_name" placeholder="Expense Name" id="expense_name">
        </div>
        <div class="form-group col-md-12">
            <label for="item_price">Expense Price</label>
            <input type="number" class="form-control" name="expense_price" placeholder="Expense Price" id="expense_price">
        </div>
        {{-- <div class="form-group col-md-12">
            <label for="item_type">Expense Description</label>
            <textarea name="expense_desc" id="expense_desc" class="form-control mb-2"></textarea>
        </div> --}}
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Add <i class="fa fa-plus-square"></i></button>
        </div>
    </div>
</form>
<script>
    $('#expenses_form').submit(function(e){
        e.preventDefault();
        // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        const fd = new FormData(this);
        if (        
        $('#expense_name').val() == '' ||            
        $('#expense_price').val() == ''     
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Adding...');
        $.ajax({
            url: '{{ route('expense.add') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status == 200) {
                    Swal.fire(
                        'Expense',
                        'Added Sucessfully',
                        'success'
                    );
                    $('#expenses_form').trigger('reset');
                    $('#save-btn').text('Add');
                }else if (res.status == 300) {
                    Swal.fire(
                        'Expense',
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