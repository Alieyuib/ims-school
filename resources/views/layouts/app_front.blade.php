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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
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
        <!-- Navigation-->
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
        <header class="masthead-front">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Your Favorite Place for learning <b><span class="text-ims-default">Islamic</span> knowledge</b></h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-light mb-5">Your Favorite Place for learning <b>Islamic knowledge</b> Click the button below to enroll</p>
                        <a class="btn btn-ims-orange btn-xl" href="{{ route('front.online.registration') }}">Register Now</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Portfolio-->
        <div id="gallery">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <h2 class="text-center text-ims-default p-2">Our Gallery</h2>
                    <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53.jpg')}}">
                          <img src="{{asset('images/PHOTO-2022-09-03-22-46-53.jpg')}}" alt="Cinque Terre" width="600" height="400">
                        </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(1).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(1).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(6).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(6).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(8).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(8).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(4).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(4).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(10).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(10).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(3).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(3).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                      <div class="gallery col-md-3">
                        <a target="_blank" href="{{asset('images/PHOTO-2022-09-03-22-46-53(2).jpg')}}">
                            <img src="{{asset('images/PHOTO-2022-09-03-22-46-53(2).jpg')}}" alt="Cinque Terre" width="600" height="400">
                          </a>
                        {{-- <div class="desc">Add a description of the image here</div> --}}
                      </div>
                </div>
            </div>
        </div>
        <!-- About-->
        {{-- <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!</p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">At Your Service</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Sturdy Themes</h3>
                            <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Up to Date</h3>
                            <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Ready to Publish</h3>
                            <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Made with Love</h3>
                            <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
                <a class="btn btn-light btn-xl" href="https://startbootstrap.com/theme/creative/">Download Now!</a>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>+1 (555) 123-4567</div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted text-ims-default">Copyright &copy; {{date('Y')}} - The Priority School</div></div>
        </footer>
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
    </body>
</html>
