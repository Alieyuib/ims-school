@extends('layouts.app_student')

@section('content')
<div class="row bio-data-row">
    <div class="col-md-4 bio-data-div card" id="bio-data-info">
        <div class="row">
            <div class="col-md-12 text-center avatar-div">
                <img src="{{asset('images/avatar.jpg')}}" alt="">
            </div>
            <div class="col-md-6 text-center">
                a
            </div>
            <div class="col-md-6 text-center">
                b
            </div>
            <div class="col-md-6 text-center">
                c
            </div>
            <div class="col-md-6 text-center">
                d
            </div>
        </div>
    </div>
    <div class="col-md-7 bio-data-div card" id="bio-data">
        
    </div>
</div>
<script>

    function printReceipt(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
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

        })

        $('#print-btn').on("click", function(el){
            printReceipt('receipt')
        })

</script>
@endsection