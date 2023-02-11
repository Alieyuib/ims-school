@extends('layouts.app')

@section('content')
<div class="row bio-data-row">
    <div class="col-md-4 bio-data-div card shadow">
        {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-bio-data"> --}}
        <div class="row">
            @foreach ($student_bio as $item) 
            <div class="col-md-12 text-center avatar-div">
                <img src="{{asset('images/logo.jpg')}}" alt="">
                <h4 class="">THE PRIORITY SCHOOL</h4>
                <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            </div>
            <div class="row bio-data-img">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center img-bio">
                    <img src="../../../../storage/images/{{ $item->passport }}" alt="">
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-md-12 text-center name-bio">
                <h5 id="fullname">{{ $item->name }}</h5>
            </div>
            {{-- <div class="col-md-12 bio-footer"></div> --}}
        </div>
    </div>
    <div class="col-md-7 bio-data-div card" id="bio-data" style="height: 650px !important">
        <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-biodata">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow p-2 mt-4">
                    <p class="text-center fs-5 text-ims-default text-uppercase">Current class</p>
                    <p class="text-center text-ims-orange fs-5 fw-bold text-uppercase">{{$item->current_class}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow p-2 mt-4">
                    <p class="text-center fs-5 text-ims-default text-uppercase">Balance</p>
                    <p class="text-center text-ims-orange fs-5 fw-bold text-uppercase">
                    @if ($item->balance > 0)
                        &#8358; -{{number_format($item->balance)}}
                    @else
                        &#8358; -0
                    @endif
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card p-2 mt-2">
                    <a href="/dashboard/generate/invoice/{{$item->id}}" class="text-uppercase btn btn-ims-green">
                        Generate invoice
                    </a>
                    <a href="/dashboard/receipt/{{$item->id}}" class="text-uppercase mt-2 btn btn-ims-green">
                        Generate Receipt
                    </a>
                    <a href="/dashboard/invoice/recent/{{$item->email}}" class="text-uppercase mt-2 btn btn-ims-orange">
                        View recent invoice
                    </a>
                    <a href="/dashboard/receipt/recent/{{$item->email}}" class="text-uppercase mt-2 btn btn-ims-orange">
                        View recent receipt
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow p-2 mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-dark mt-3" style="font-size: 13px; font-weight: 600">Transactions by {{$item->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <a href="/dashboard/new/transaction/{{$item->id}}/{{$item->email}}" class="btn btn-ims-green btn-sm mt-2" style="float: right">
                                Add new transaction
                            </a>
                            <a href="/dashboard/edit/balance/{{$item->email}}" class="btn btn-ims-green btn-sm mt-2">
                               Edit balance
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="transactions">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr class="text-ims-default">
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Ref</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction_list as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}</td>
                                            <td>&#8358; {{number_format($transaction->amount)}}</td>
                                            <td>{{$transaction->remarks}}</td>
                                            <td>{{$transaction->trans_id}}</td>
                                            <td>{{$transaction->created_at}}</td>
                                            <td>
                                                <p>
                                                    <a href="/dashboard/edit/transaction/{{$transaction->id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <button id="{{$transaction->id}}" class="deleteIcon btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>

    $('table').DataTable({
        order: [0, 'desc'],
    });

    function printReceipt(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    };
    // view result
    $(document).on('click', '#print_fee_schedule', function(e){
            e.preventDefault();
            // let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('portal.finance.view') }}',
                method: 'get',
                data: {
                    // id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                }
            })

        });

        // delete data 
        $(document).on('click', '.deleteIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            console.log(id);
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
                    url: '{{ route('dashboard.delete.transaction') }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res){
                       console.log(res);
                       Swal.fire(
                           'Transaction',
                           'Deleted',
                           'success'
                       )  
                       location.reload(true)
                    //    fetchAllItem();
                    }
                })
            }
            })
        })

        $('#student_bio_id').on('change', function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '{{ route('portal.biodata.get') }}',
                method: 'get',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#firstname').val(res.name);
                    $('#student_id').val(res.id);
                    $('#student_passport').val(res.passport);
                    // $('#lastname').val(res.lname);
                    $('#familyname').val(res.ffname);
                    $('#email').val(res.email);
                    $('#pob').val(res.pob);
                    $('#current_class').val(res.current_class);
                    $('#date_admitted').val(res.date_admitted);
                    $('#dob').val(res.dob);
                    $('#guard').val(res.guardian);
                    $('#phone').val(res.phone_no);
                    $('#school').val(res.name_of_school);
                    $('#subject').val(res.Subject_learned);
                    $('#passport-div').html(`<img src="../../storage/images/${res.passport}" class="img-thumbnail">`)
                    $('#address').val(res.address);
                    $('#sickness').val(res.sickness_allergy);
                    $('#fullname').text(res.name);
                    $('#family').text(res.ffname);
                    $('#pob_bio').text(res.pob);
                    $('#dob_bio').text(res.dob);
                    $('#sickness_bio').text(res.sickness_allergy);
                    $('#phone_bio').text(res.phone_no);
                    $('#email_bio').text(res.email);
                    $('.img-bio').html(`<img src="../../storage/images/${res.passport}" class="img-thumbnail">`)
                    $('#address_bio').text(res.address);
                }
            })
        })

        // update student biodata
        $('#bio-data-form').submit(function(e){
            e.preventDefault();
            const fd  = new FormData(this);
            $('#save-btn-bio-data').text('Saving...');
            $.ajax({
                url: '{{ route('portal.biodata.update') }}',
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
                            'Student',
                            'Data Updated Successfully',
                            'success'
                        );
                        // $('#edit_student_form').trigger('reset');
                        // $('#editStudentModal').modal('hide');
                        $('#save-btn-bio-data').text('Save');
                        // fetchAllStudents();
                    }else if (res.status == 300) {
                        Swal.fire(
                            'Student',
                            'Data Not Updated',
                            'error'
                        );
                        $('#save-btn-bio-data').text('Save');
                    } 
                }
            })
            
        })

        $('#print-btn').on("click", function(el){
            printReceipt('receipt')
        })

</script>
@endsection