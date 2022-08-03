@extends('layouts.app_student')

@section('content')
<div class="row bio-data-row">
    <div class="col-md-4 bio-data-div card" id="bio-data-info">
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
                    {{-- <img src="{{asset('images/avatar.jpg')}}" alt=""> --}}
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-md-12 text-center name-bio">
                <h3 id="fullname"></h3>
            </div>
            <div class="col-md-12 bio-footer"></div>
        </div>
    </div>
    <div class="col-md-7 bio-data-div card" id="bio-data" style="height: 550px">
        <div class="col-md-12">
            <label for="student_bio_id">Select Student</label>
            <select name="student_bio_id" id="student_bio_id" class="form-control">
               @foreach ($student_bio as $item)
                   <option value="{{ $item->id }}">{{ $item->fname }}</option>
               @endforeach
            </select>
        </div>
        <img src="{{ asset('images/logo.jpg') }}" alt="" class="background-img-biodata">
        <form action="#" class="bio-data-form col-md-12" id="bio-data-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="student_id" id="student_id">
            <input type="hidden" name="student_passport" id="student_passport">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="firstname">Fullname</label>
                    {{-- <input type="hidden" class="form-control" name="status" id="status" value="1"> --}}
                    <input type="text" class="form-control" name="fname" placeholder="Firstname" id="firstname">
                    <input type="hidden" class="form-control" name="lname" placeholder="Lastname" id="lastname" value="xyz">
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="lastname">Lastname</label>
                    
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="familyname">Family Name</label>
                    <input type="text" class="form-control" name="ffname" placeholder="Family Name" id="familyname">
                </div>
                <div class="form-group col-md-4">
                    <label for="dob">DOB</label>
                    <input type="text" class="form-control" name="dob" placeholder="DOB" id="dob">
                </div>
                <div class="form-group col-md-4">
                    <label for="pob">POB</label>
                    <input type="text" class="form-control" name="pob" placeholder="Place of Birth" id="pob">
                </div>
                <div class="form-group col-md-4">
                    <label for="sickness">Sickness/Allergy</label>
                    <input type="text" class="form-control" name="sickness" placeholder="Sickness/Allergy" id="sickness">
                </div>
                <div class="form-group col-md-4">
                    <label for="guard">Guardian/Husband</label>
                    <input type="text" class="form-control" name="guard" placeholder="Guardian/Husband" id="guard">
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" id="phone">
                </div>
                <div class="form-group col-md-4">
                    <label for="school">Name of School</label>
                    <input type="text" class="form-control" name="school" placeholder="Name of School" id="school">
                </div>
                <div class="form-group col-md-4">
                    <label for="subject">Subject Learned</label>
                    <input type="text" class="form-control" name="subject" placeholder="Subject Learned" id="subject">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" id="email">
                </div>
                <div class="form-group col-md-4">
                    <label for="passport">Passport</label>
                    <input type="file" name="avatar" class="form-control" id="passport">
                </div>
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" id="address">
                </div>
                <div class="form-group col-md-12">
                   <button class="btn ims-bg-green text-light" type="submit" id="save-btn-bio-data">Save <i class="fa fa-save"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

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
                    $('#firstname').val(res.fname);
                    $('#student_id').val(res.id);
                    $('#student_passport').val(res.passport);
                    // $('#lastname').val(res.lname);
                    $('#familyname').val(res.ffname);
                    $('#email').val(res.email);
                    $('#pob').val(res.pob);
                    $('#dob').val(res.dob);
                    $('#guard').val(res.guardian);
                    $('#phone').val(res.phone_no);
                    $('#school').val(res.name_of_school);
                    $('#subject').val(res.Subject_learned);
                    $('#passport-div').html(`<img src="../../storage/images/${res.passport}" class="img-thumbnail">`)
                    $('#address').val(res.address);
                    $('#sickness').val(res.sickness_allergy);
                    $('#fullname').text(res.fname);
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