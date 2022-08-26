@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <a href="" class="btn btn-ims-green my-1" id="print-btn"><i class="fa fa-print"></i>Print ID Card</a>
    </div>
</div>
<div class="row" id="idcard">
    <div class="col-md-4 idcard-div card" id="bio-data-info">
        {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-bio-data"> --}}
        <div class="row">
            <div class="col-md-12 text-center avatar-div">
                <img src="{{asset('images/logo.jpg')}}" alt="">
                <h4 class="">THE PRIORITY SCHOOL</h4>
                <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
            </div>
            <div class="row bio-data-img">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center img-bio">
                    <img src="../../storage/images/{{ $passport }}" alt="">
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-md-12 text-center name-bio">
                <h3 id="fullname">{{ $student_name }}</h3>
            </div>
            <div class="col-md-12 bio-footer"></div>
        </div>
    </div>
    <div class="col-md-4 idcard-div card p-4" id="bio-data-info">
        {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-bio-data"> --}}
        <div class="row">
            <div class="col-md-12 text-center avatar-div">
                <h6 class=""><b>This is to certify that the bearer whose name, signaturen & photograph appeared overleaf is a student of</b></h6>
                <img src="{{asset('images/logo.jpg')}}" alt="" style="width: 25%">
                <h4 class="text-ims-default">THE PRIORITY SCHOOL</h4>
                <h4 class="text-ims-orange">المدرسة ذات الأولوية</h4>
                <h6 class="text-dark" style="text-transform: lowercase"><b>NO: 3 BILYAMINU STREET OFF EBITUUKIWE, JABI ABUJA</b></h6>
                <br>
                <h5><i>If found please return to the address overleaf or to the nearest police station</i></h5>
            </div>
            <div class="col-md-12 text-center name-bio">
                <h6><b>__________________________________</b></h6>
                <h5 id="fullname">HEAD TEACHER SIGN</h5>
            </div>
            <div class="col-md-12 bio-footer-2 my-3"></div>
        </div>
    </div>
</div>
    <script>
        $('table').DataTable({
            order: [0, 'asc'],
        });

        function printReceipt(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
        }

        $('#print-btn').on('click', function(e){
            e.preventDefault();
            printReceipt('idcard');
        })
    </script>
@endsection
{{-- </body>
</html> --}}

