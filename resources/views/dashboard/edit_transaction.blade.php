@extends('layouts.app')

@section('content')

<form action="#" method="POST" id="grade_student_form" enctype="multipart/form-data" class="card shadow grading-container grade-form"> 
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" class="logo-gradeform">
            <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
            <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            <h6 class="text-ims-default">Edit Transaction</h6>
        </div>
    </div>
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label for="amount">Amount</label>
            <input value="{{$transaction_data->amount}}" type="text" class="form-control" name="amount" placeholder="Amount" id="amount">
            <input type="hidden" class="form-control" name="tid" value="{{$transaction_data->id}}">
            {{-- <input type="hidden" class="form-control" name="email" value=""> --}}
        </div>
        <div class="form-group col-md-12">
            <label for="remarks">Remarks</label>
            <input value="{{$transaction_data->remarks}}" type="text" class="form-control" name="remarks" placeholder="Remarks" id="remarks">
        </div>
        <div class="form-group col-md-12">
            <label for="trans-id">Teller no/Ref</label>
            <input value="{{$transaction_data->trans_id}}" type="text" class="form-control" name="trans-id" placeholder="Teller no/Ref" id="trans-d">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-ims-green grade-btn" type="submit" id="save-btn">Edit <i class="fa fa-plus"></i></button>
        </div>
    </div>
</form>
<script>
    $('#grade_student_form').submit(function(e){
        e.preventDefault();
        // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        const fd = new FormData(this);
        if (
        $('#amount').val() == '' ||            
        $('#trans-id').val() == ''        
        ) {
        Swal.fire(
            'All Form',
            'Input fields are require',
            'warning'
        )
    }else{

        $('#save-btn').text('Submitting transaction...');
        $.ajax({
            url: '{{ route('dashboard.edit.transaction') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                console.log(res);
                if (res.status == 200) {
                    Swal.fire(
                        'Transaction',
                        'Submitted Sucessfully',
                        'success'
                    );
                    $('#grade_student_form').trigger('reset');
                    $('#save-btn').text('Edit');
                    // window.history.back(-1)
                }else if (res.status == 300) {
                    Swal.fire(
                        'Transaction',
                        'Error',
                        'error'
                    )
                } 
            }
        });
    }
        
    });
</script>
@endsection