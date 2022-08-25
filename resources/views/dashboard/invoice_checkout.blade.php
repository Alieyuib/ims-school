@extends('layouts.app')

@section('content')
<style>
    
</style>
<div class="container">
    <div class="row my-1">
    <div class="col-md-4" id="add_items">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="text-success">Add Items</h3>
            </div>
            <div class="card-body bg-orange text-center" id="show_all_students">
                <div class="row my-2">
                    <div class="col-md-12 card p-2">
                        <form action="" class="add_item_form" method="POST" id="add_item_form">
                            @csrf
                            <input type="hidden" name="student_id" class="form-control" value="{{ $student_data->id }}"> 
                            <input type="hidden" name="order_id" class="form-control" value="{{ $order_id }}" id="order_id"> 
                            <input type="hidden" name="item_price" class="form-control" id="item_price"> 
                            <input type="hidden" name="item_name" class="form-control" id="item_name"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="item_name">Item Name</label>
                                    <select name="item_selected" id="item_selected" class="form-control">
                                        @foreach ($item_list as $item)
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
                                    <input type="text" name="item_quantity" class="form-control"> 
                                </div>
                                <div class="col-md-2">
                                <button class="btn btn-ims-orange my-4" id="add_btn"><i class="fa fa-plus-square"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="btn-lg btn-ims-green my-3" style="width: 100%" id="print_btn"><i class="fa fa-print"></i>&nbsp;Print Invoice</button>
                <button class="btn-lg btn-ims-orange my-1" style="width: 100%" id="save_btn"><i class="fa fa-save"></i>&nbsp;Save Invoice</button>
            </div>
        </div>
    </div>
      <div class="col-md-8">
        <div class="card shadow student-list-div-3 invoice" id="invoice">
          {{-- <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-success">Invoice #{{ $order_id }}</h3>
            <input type="hidden" id="order_id_invoice" value="{{ $order_id }}">
          </div> --}}
          <div class="card-body bg-orange text-center" id="show_all_students">
            <img src="{{ asset('images/logo.jpg') }}" alt="" style="width: 10%">
              <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
              <h6 class="text-dark">NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</h6>
              <h6 class="text-ims-orange"><b>TO</b></h6>
              <h6 class="text-ims-default"><b class="text-ims-orange">STUDENT NAME</b>: {{ $student_data->name }} <b class="text-ims-orange">EMAIL</b>: {{ $student_data->email }}</h6>
              <h6 class="text-ims-default"><b class="text-ims-orange">ADDRESS</b>: {{ $student_data->address }}</h6>
              <h6 class="text-ims-default"><b class="text-ims-orange">DATE</b>: {{ date('D/M/Y') }}</h6>
              <h5 class="text-ims-default"><b>Invoice #{{ $order_id }}</b></h5>
              <input type="hidden" id="order_id_invoice" value="{{ $order_id }}">
              <input type="hidden" id="student_email" value="{{ $student_data->email }}">
                
                <div id="show_cart_items">

                </div>
              <div class="row my-5">
                <div class="col-md-12 payment">
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

         $('#add_item_form').on('submit', function(e){
            e.preventDefault();
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
                        fetchAllTransactions()
                    }
                }
            });
            
        });

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

