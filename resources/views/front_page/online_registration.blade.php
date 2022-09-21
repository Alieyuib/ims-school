<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>The Priority School</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('app-assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('app-assets/css/main.css') }}">
        <style>
            /* Dropdown Button */
.dropbtn {
 background-color: transparent;
 color: white;
 /* padding: 5px; */
 font-size: 16px;
 border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
 position: relative;
 display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
 display: none;
 position: absolute;
 background-color: #f1f1f1;
 min-width: 160px;
 box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
 z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
 color: black;
 padding: 12px 16px;
 text-decoration: none;
 display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #414141;} 
       </style>
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light py-2" id="mainNav">
            <div class="container-fluid px-4 px-lg-5">
                <a class="navbar-brand text-ims-default" href="{{ route('front.page') }}">
                    <img src="{{asset('images/logo.jpg')}}" alt="">
                    The Priority School
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto text-ims-default my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link text-ims-default" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link text-ims-default" href="#services">Contact</a></li>
                        <li class="nav-item"><a class="nav-link text-ims-default" href="#gallery">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link text-ims-default" href="{{ route('front.online.registration') }}">Online Registration</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('portal.index') }}">Student Portal</a></li> --}}
                        <div class="dropdown">
                        <li class="dropbtn nav-item"><a href="#" class="nav-link text-ims-default">Portals</a></li>
                            <div class="dropdown-content" style="margin-left: -100px; width: 100%">

                                {{-- <a class="nav-link" href="{{ route('portal.index') }}">Student/Family Portal</a>
                                <a class="nav-link" href="{{ route('portal.teacher.index') }}">Teachers Portal</a> --}}
                                <a class="nav-link" href="{{ route('login') }}">Administrative Portal</a>
                            </div>
                        </div> 
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 online-reg-form text-center shadow">
                        <img src="{{ asset('images/logo.jpg') }}" alt="" style="width: 12%; margin-top:10px">
                        <h3 class="text-ims-orange">The Priority School</h3>
                        <h4 class="text-ims-default">Online Registration</h4>
                        <h6 class="text-ims-default">Please ensure that the form is properly completed and all information given therein is correct to the best of your knowledge.</h6>
                        <form action="#" method="POST" enctype="multipart/form-data" class="online-form col-md-12" id="online-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="firstname">Fullname</label>
                                    {{-- <input type="hidden" class="form-control" name="status" id="status" value="0"> --}}
                                    <input type="text" class="form-control" name="fname" placeholder="Firstname" id="fname">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="familyname">Family Name</label>
                                    <input type="text" class="form-control" name="ffname" placeholder="Family Name" id="ffname">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">DOB</label>
                                    <input type="date" class="form-control" name="dob" placeholder="DOB" id="dob">
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
                                {{-- <div class="form-group col-md-12">
                                    <label for="address">Term & Condition</label>
                                    <input type="checkbox" class="form-control" name="address" placeholder="Address" id="address">
                                </div> --}}
                                <button type="submit" id="add_student_btn" class="btn btn-ims-orange">Register</button>
                            </div>
                        </form>
                        <div class="col-md-12 text-center">
                            <button class="pdf-format btn">
                                <i class="fa fa-file-pdf-o fa-3x text-ims-default"></i>
                            </button>
                            <button class="word-format btn">
                                <i class="fa fa-file-text fa-3x text-ims-orange"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <div class="col-lg-8 align-self-baseline">
                        <p class="text-light mb-5">Your Favorite Place for learning <b>Islamic knowledge</b> Click the button below to enroll</p>
                        <a class="btn btn-ims-orange btn-xl" href="#about">Enroll Now</a>
                    </div> --}}
                </div>
            </div>
        </header>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted text-ims-default">Copyright &copy; {{date('Y')}} - The Priority School</div></div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('app-assets/js/app.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('app-assets/js/scripts.css') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script>
            // Adding New student
            $('#online-form').submit(function(e){
                e.preventDefault();
                // var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
                const fd = new FormData(this);
                if (
                $('#fname').val() == '' ||                   
                $('#ffname').val() == '' ||            
                $('#pob').val() == '' ||            
                $('#dob').val() == '' ||            
                $('#sickness').val() == '' ||            
                $('#guard').val() == '' ||            
                $('#phone').val() == '' ||            
                $('#school').val() == '' ||            
                $('#subject').val() == '' ||            
                $('#email').val() == '' ||            
                $('#address').val() == ''  ||
                $('#passport').val() == ''         
                ) {
                Swal.fire(
                    'All Form',
                    'Input fields are require',
                    'warning'
                )
            }else{
                $('#add_student_btn').text('Registering...');
                $.ajax({
                    url: '{{ route('registration.online') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        console.log(res);
                        if (res.status == 200) {
                            Swal.fire(
                                'Student',
                                'Registration Sucessfully',
                                'success'
                            );
                            // fetchAllEmployees();
                            $('#online-form').trigger('reset');
                            $('#add_student_btn').text('Register');
                        }else if (res.status == 300) {
                            Swal.fire(
                                'Student',
                                'Registration Not Sucessfully',
                                'error'
                            )
                        } 
                    }
                });
            }
                
            });
        </script>
    </body>
</html>
