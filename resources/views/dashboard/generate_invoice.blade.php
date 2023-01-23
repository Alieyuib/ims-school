@extends('layouts.app')

@section('content')
<div class="card shadow student-list-div-main">
    <div class="">
    <h3 class="text-ims-default">Generate Invoice(تسجيل جميع الطلاب)</h3>
    <form method="post" class="p-2">
        <p>
           <select name="class_name" class="form-control" id="class_name" style="width: 100%; border: 1px solid #dedede">
                <option value="#" disabled selected>Filter by class</option>
                <option value="class 1">Class 1</option>
                <option value="class 2">Class 2</option>
                <option value="class 3">Class 3</option>
                <option value="class 4">Class 4</option>
                <option value="hadaanah">Hadaanah</option>
                <option value="Faslul Hifiz">Faslul Hifiz</option>
                <option value="Arraudatul Ola">Arraudatul Ola</option>
                <option value="Arrauda Ath-thaaniya">Arrauda ath thaaniya</option>
            </select>
        </p>
    </form>
    </div>
    @if (session()->has('status'))
        <div class="alert alert-success my-2">
            {{  session('status') }}
        </div>
    @endif
    <div id="show_all_students">
    <h1 class="text-center text-secondary my-5">
        <img src="{{asset('images/Hourglass.gif')}}" alt="" srcset="">
    </h1>
    </div>
</div>
    <script>
        // Fetch All Employee
        setTimeout(() => {
            fetchAllTransactions();
        },2500);


        function fetchAllTransactions() {
            $.ajax({
                url: '{{ route('dashboard.logs.generate') }}',
                method: 'get',
                success: function(res){
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'asc'],
                    });
                }
            })
        }

        $('#class_name').on('change', function(e){
            e.preventDefault();
            let class_name = $(this).val();
            $.ajax({
                url: '{{ route('dashboard.filter.class') }}',
                method: 'get',
                data:{
                    class_name: class_name,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res){
                    // console.log(res);
                    $('#show_all_students').html(res);
                    $('table').DataTable({
                        order: [0, 'asc'],
                    });
                }
            })
        })

        // $(document).on('click', '.generateIcon', function(e){
        //     e.preventDefault();
        //     let id  = $(this).attr('id');
        //     $.ajax({
        //         url: '{{ route('get.invoice.data') }}',
        //         method: 'get',
        //         data: {
        //             id: id,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(res){
        //             console.log(res);
        //             if (res.status == 200) {
        //                 Swal.fire(
        //                     'Invoice',
        //                     'Generated',
        //                     'success'
        //                 );
        //                 // fetchAllTransactions();
        //             }else if (res.status == 300) {
        //                 Swal.fire(
        //                     'Invoice',
        //                     'Generated',
        //                     'error'
        //                 );
        //             }
        //         }
        //     })
        // })
        
    </script>
@endsection
{{-- </body>
</html> --}}

