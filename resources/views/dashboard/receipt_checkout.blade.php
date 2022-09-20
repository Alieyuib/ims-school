@extends('layouts.app')

@section('content')
<style>
    
</style>
<div class="container">
    <div class="row my-1">
    <div class="col-md-4 generate-receipt" id="add_items">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="text-success">Generate Receipt</h3>
            </div>
            <div class="card-body bg-orange text-center" id="show_all_students">
                <div class="row my-2">
                    <div class="col-md-12 card p-4">
                        <form action="" class="add_item_form" method="POST" id="add_item_form">
                            @csrf
                            <input type="hidden" name="student_id" class="form-control" value="{{ $student_data->id }}"> 
                            <input type="hidden" name="order_id" class="form-control" value="{{ $order_id }}" id="order_id"> 
                            <input type="hidden" name="item_price" class="form-control" id="item_price"> 
                            <input type="hidden" name="item_name" class="form-control" id="item_name"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="item_name">Uniform</label>
                                    <select name="item_selected" id="item_selected" class="form-control">
                                        <option value="">---Select Item---</option>
                                        @foreach ($item_uniform as $item)
                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>   
                                        @endforeach   
                                    </select> 
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="item_price">Item Price in &#8358;</label>
                                    <input type="text" name="item_price" class="form-control" id="item_price"> 
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="item_name">Quantity</label>
                                    <input type="text" name="item_quantity" value="{{$count}}" class="form-control"> 
                                </div>
                                <div class="col-md-2">
                                <button class="btn btn-ims-orange my-4" id="add_btn_uni"><i class="fa fa-plus-square"></i></button>
                                </div>
                            </div>
                        </form>
                        <form action="" class="add_item_form" method="POST" id="add_item_form_fee">
                            @csrf
                            <input type="hidden" name="student_id" class="form-control" value="{{ $student_data->id }}"> 
                            <input type="hidden" name="order_id" class="form-control" value="{{ $order_id }}" id="order_id"> 
                            <input type="hidden" name="item_price" class="form-control" id="item_price_fee"> 
                            <input type="hidden" name="item_name" class="form-control" id="item_name_fee"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="item_name">School Fee</label>
                                    <select name="item_selected" id="item_selected_fee" class="form-control">
                                        <option value="" selected>---Select Item---</option>
                                        @foreach ($item_fee as $item)
                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>   
                                        @endforeach  
                                    </select>  
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="item_price">Item Price in &#8358;</label>
                                    <input type="text" name="item_price" class="form-control" id="item_price"> 
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="item_name">Quantity</label>
                                    <input type="text" name="item_quantity" value="{{$count}}" class="form-control"> 
                                </div>
                                <div class="col-md-2">
                                <button class="btn btn-ims-orange my-4" id="add_btn_fee"><i class="fa fa-plus-square"></i></button>
                                </div>
                            </div>
                        </form>
                        <form action="" class="add_item_form" method="POST" id="add_item_form_sta">
                            @csrf
                            <input type="hidden" name="student_id" class="form-control" value="{{ $student_data->id }}"> 
                            <input type="hidden" name="order_id" class="form-control" value="{{ $order_id }}" id="order_id"> 
                            <input type="hidden" name="item_price" class="form-control" id="item_price_sta"> 
                            <input type="hidden" name="item_name" class="form-control" id="item_name_sta"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="item_name">Stationaries</label>
                                    <select name="item_selected" id="item_selected_sta" class="form-control">
                                        <option value="">---Select Item---</option>
                                        @foreach ($item_stationary as $item)
                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>   
                                        @endforeach  
                                    </select>  
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="item_price">Item Price in &#8358;</label>
                                    <input type="text" name="item_price" class="form-control" id="item_price"> 
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="item_name">Quantity</label>
                                    <input type="text" name="item_quantity" value="{{$count}}" class="form-control"> 
                                </div>
                                <div class="col-md-2">
                                <button class="btn btn-ims-orange my-4" id="add_btn_sta"><i class="fa fa-plus-square"></i></button>
                                </div>
                            </div>
                        </form>
                        {{-- <form action="" class="add_item_form" method="POST" id="add_item_form_discount">
                            @csrf
                            <input type="hidden" name="student_id" class="form-control" value="{{ $student_data->id }}"> 
                            <input type="hidden" name="order_id" class="form-control" value="{{ $order_id }}" id="order_id"> 
                            <input type="hidden" name="item_price" class="form-control" id="item_price_sta"> 
                            <input type="hidden" name="item_name" class="form-control" id="item_name_sta"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">&#8358;Discount</label>
                                    <input type="number" name="discount" id="discount_amount" class="form-control"> 
                                </div>
                                <div class="col-md-12">
                                <button class="btn btn-ims-orange my-4" id="discount_btn">
                                    Add Discount
                                </button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
                {{-- <button class="btn-lg btn-ims-green my-3" style="width: 100%" id="print_btn"><i class="fa fa-print"></i>&nbsp;Print Invoice</button> --}}
                {{-- <button class="btn-lg btn-ims-orange my-1" style="width: 100%" id="save_btn"><i class="fa fa-save"></i>&nbsp;Save Invoice</button> --}}
                <form action="{{ route('dashboard.receipt.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id_invoice" id="order_id_invoice" value="{{ $order_id }}">
                    <input type="hidden" name="student_email" id="student_email" value="{{ $student_data->email }}">
                    <input type="hidden" name="student_name" id="student_name" value="{{ $student_data->name }}">
                    <input type="hidden" name="student_address" id="student_address" value="{{ $student_data->address }}">
                    <label for="">&#8358; Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount">
                    {{-- <label for="student_email_invoice" class="my-1"><b>Email Address</b></label> --}}
                    {{-- <input type="email"class='form-control' name="student_email_invoice" id="student_email_invoice" value="{{ $student_data->email }}"> --}}
                    {{-- <button class="btn-lg btn-ims-orange my-3" style="width: 100%" type="submit"><i class="fa fa-send"></i>&nbsp;Email Receipt</button> --}}
                    <button class="btn-lg btn-ims-green my-3" style="width: 100%" type="submit"><i class="fa fa-print"></i>&nbsp;Print Receipt</button>
                </form>
                <form action="{{ route('dashboard.send.receipt') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id_invoice" id="order_id_invoice" value="{{ $order_id }}">
                    <input type="hidden" name="student_email" id="student_email" value="{{ $student_data->email }}">
                    <input type="hidden" name="student_name" id="student_name" value="{{ $student_data->name }}">
                    <input type="hidden" name="student_address" id="student_address" value="{{ $student_data->address }}">
                    {{-- <label for="">&#8358; Discount</label> --}}
                    {{-- <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount"> --}}
                    <label for="student_email_invoice" class="my-1"><b>Email Address</b></label>
                    <input type="email"class='form-control' name="student_email_invoice" id="student_email_invoice" value="{{ $student_data->email }}">
                    <button class="btn-lg btn-ims-orange my-3" style="width: 100%" type="submit"><i class="fa fa-send"></i>&nbsp;Email Receipt</button>
                    {{-- <button class="btn-lg btn-ims-green my-3" style="width: 100%" type="submit"><i class="fa fa-print"></i>&nbsp;Print Receipt</button> --}}
                </form>
            </div>
        </div>
    </div>
      <div class="col-md-8 static-invoice">
        <div class="card shadow student-list-div-3 invoice" id="invoice">
          {{-- <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Invoice #{{ $order_id }}</h3>
            <input type="hidden" id="order_id_invoice" value="{{ $order_id }}">
          </div> --}}
          <div class="card-body bg-orange" id="show_all_students">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="" style="width: 80%;">
                </div>
                <div class="col-md-8 invoice-header">
                    <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
                    <h6 class="text-dark">NO: 2 Bilyaminu Street off Ebituukiwe, Jabi Abuja</h6>
                </div>
                <div class="col-md-12" style="margin-top: 20px">
                    <h6 class="text-dark"><b class="text-dark">Receipt</b>: #{{ $order_id }}</h6>
                    <h6 class="text-dark"><b class="text-dark">Receipt Date</b>: {{ date('d/m/y') }}</h6>
                </div>
            </div>
              <h6 class="text-dark"><b class="text-dark">Name</b>: {{ $student_data->name }}</h6>
              <h6 class="text-dark"><b class="text-dark">Email</b>: {{ $student_data->email }}</h6>
              <h6 class="text-dark"><b class="text-dark">Address</b>: {{ $student_data->address }}</h6>
                <div id="show_cart_items">

                </div>
              <div class="row my-5">
                <div class="col-md-12 payment text-center">
                    <h5><b>Signature/Date</b></h5>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script>
        // window.jsPDF = window.jspdf.jsPDF;
        // // const doc = new jsPDF();
        // var specialElementHandlers = {
        //     '#add_items': function (element, renderer) {
        //         return true;
        //     }
        // };
        // $('#print_btn').click(function () {
        //     jsPDF().fromHTML($('#invoice').html(), 15, 15, {
        //         'width': 170,
        //             'elementHandlers': specialElementHandlers
        //     });
        //     jsPDF().save('invoice_the_priority_school.pdf');
        // });

        function fetchAllTransactions() {
            let order_id = $('#order_id').val();
            $.ajax({
                url: '{{ route('dashboard.get.cart') }}',
                method: 'get',
                data:{
                    order_id: order_id,
                },
                success: function(res){
                    $('#show_cart_items').html(res);
                }
            })
        }
        
        function printReceipt(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
        }

        // $('#print_btn').click(function () {
        //     doc.fromHTML($('#invoice').html(), 15, 15, {
        //         'width': 170,
        //             'elementHandlers': specialElementHandlers
        //     });
        //     doc.save('invoice_the_priority_school.pdf');
        // });

        $('#send_btn').on('click', function(e){
            e.preventDefault();
            let order_id = $('#order_id').val();
            let student_email = $('#student_email').val();
            let student_name = $('#student_name').val();
            let student_address = $('#student_address').val();
            $.ajax({
                    type: 'post',
                    url: '{{ route('dashboard.send.invoice') }}',
                    data:{
                        order_id: order_id, 
                        student_email: student_email, 
                        student_name: student_name, 
                        student_address: student_address, 
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(data){
                        console.log(data);
                        // printReceipt('invoice')
                    }
                });
        })

        $('#print_btn').on('click', function(e) {
            e.preventDefault();
            printReceipt('invoice')
        })

        $('#save_btn').on("click", function(el){
            let order_id = $('#order_id').val();
            let student_email = $('#student_email').val();
            window.scrollTo(0,0);
            html2canvas($('#invoice'), {
                scrollY: -window.scrollY,
                onrendered: function (canvas) {
                    var img = canvas.toDataURL("image/png",2.0);

                    $.ajax({
                        type: 'post',
                        url: '{{ route('dashboard.add.invoice') }}',
                        data:{
                            img:img,
                            order_id: order_id, 
                            student_email: student_email, 
                            _token: '{{ csrf_token() }}'
                        },
                        success:function(data){
                            if (data.status == 200) {
                                Swal.fire(
                                    '',
                                    'Saved',
                                    'success'
                                );
                            }
                            // console.log(data);
                            // printReceipt('invoice')
                        }
                    });
                }
            });
            window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
        })

        $('#item_selected').on('change', function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '{{ route('dashboard.item.price') }}',
                method: 'get',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#item_price').val(res.item_price);
                    $('#item_name').val(res.item_name);
                }
            })
        })

        $('#item_selected_sta').on('change', function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '{{ route('dashboard.item.price') }}',
                method: 'get',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#item_price_sta').val(res.item_price);
                    $('#item_name_sta').val(res.item_name);
                }
            })
        })

        $('#item_selected_fee').on('change', function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '{{ route('dashboard.item.price') }}',
                method: 'get',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    console.log(res);
                    $('#item_price_fee').val(res.item_price);
                    $('#item_name_fee').val(res.item_name);
                }
            })
        })

         $('#add_item_form').on('submit', function(e){
            e.preventDefault();
            $("#add_btn_uni").prop('disabled', true);
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            const fd = new FormData(this);

            $.ajax({
                url: '{{ route('dashboard.add.item.cart') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            '',
                            'Added to cart',
                            'success'
                        );
                        fetchAllTransactions();
                        $("#add_btn_uni").prop('disabled', false);
                    }
                }
            });
            
        });

        $('#add_item_form_fee').on('submit', function(e){
            e.preventDefault();
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            $("#add_btn_fee").prop('disabled', true);
            const fd = new FormData(this);

            $.ajax({
                url: '{{ route('dashboard.add.item.cart') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            '',
                            'Added to cart',
                            'success'
                        );
                        fetchAllTransactions();
                        $("#add_btn_fee").prop('disabled', false);
                    }
                }
            });
            
        });

        $('#add_item_form_sta').on('submit', function(e){
            e.preventDefault();
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            $("#add_btn_sta").prop('disabled', true);
            const fd = new FormData(this);

            $.ajax({
                url: '{{ route('dashboard.add.item.cart') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if (res.status == 200) {
                        Swal.fire(
                            '',
                            'Added to cart',
                            'success'
                        );
                        fetchAllTransactions();
                        $("#add_btn_sta").prop('disabled', false);
                    }
                }
            });
            
        });

        $('#add_item_form_discount').on('submit', function(e){
            e.preventDefault();
            // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            const fd = new FormData(this);
            let discount = $("#discount_amount").val();

            $.ajax({
                url: '{{ route('dashboard.invoice.discount') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    let new_amount = res.total_amount - discount;
                    $('#total_price').text(new_amount);
                    $('#discount').text('Discount of:' + discount);
                    
                }
            });
            
        });
        
        $(document).on('click', '.removeIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('remove.cart.item') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    fetchAllTransactions()
                }
            })

        })

        $('#checkout_btn').on('click', function(e){
            e.preventDefault();
            let order_id = $('#order_id_invoice').val();
            $.ajax({
                url: '{{ route('dashboard.invoice') }}',
                method: 'get',
                data:{
                    order_id: order_id,
                    // _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    console.log(res);
                    // if (res.status == 200) {
                    //     Swal.fire(
                    //         '',
                    //         'Added to cart',
                    //         'success'
                    //     );
                    //     fetchAllTransactions()
                    // }
                }
            });
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

