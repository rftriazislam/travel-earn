<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link  rel="icon"sizes="16x16" href="{{asset('logo/icon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('front_end/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('front_end/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('front_end/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/jquery.timepicker.css')}}">

    <link rel="stylesheet" href="{{asset('front_end/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}">
</head>

<body>
    <div class="wrdap" style="background:#ffffff;padding-top:10px;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5 d-flex align-items-center">
                    
                      
                          <img src="{{asset('logo/4.png')}}" style="width:90% ;heigth:100%"  alt="">
                          {{-- <a class="navbar-brand" href="{{url('/')}}" style="font-family: Arial, sans-;font-size:48px;"><span style="font-family: cursive">THIRD</span> HAN<i>D</i></a> --}}

                      
                    {{-- <img src="{{ asset('logo/4.png') }}" style="width:70px">  --}}
                </div>
                
                <div class="col-md-5">
                    <div class="row">
                        {{-- <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-location-arrow"></span></div>
                                <div class="text"><b style="color:black"> Address :House # 49, Road # 12, Sector # 11 Uttara - 1230, Dhaka, Bangladesh</b></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-location-arrow"></span></div>
                                <div class="text" style="color:black"><b>Call us<br>+8801716967050</b></div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-5 d-flex justify-content-end align-items-center">
                            <div class="social-media marginx">
                                <p class="mb-0 d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="background:#e9ecef">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <!-- <form action="#" class="searchform order-lg-last">
                <div class="form-group d-flex">
                    <input type="text" class="form-control pl-3" placeholder="Search">
                    <button type="submit" placeholder="" class="form-control search"><span
                            class="fa fa-search"></span></button>
                </div>
            </form> -->
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{route('service')}}" class="nav-link"><b>Services</b></a></li>
                    <li class="nav-item"><a href="{{route('product')}}" class="nav-link"><b>Product</b></a></li>
                    <li class="nav-item"><a href="{{route('contact')}}" class="nav-link"><b>Contact</b></a></li>
                    <li  class="nav-item">
                                    
                        @if(Auth::user()=='')
                         <a href="{{route('login')}}" class="nav-link" >login</a>

                         @elseif(Auth::user()->role=='admin')
                         <a href="{{route('admin')}}"class="nav-link">Dashboard</a>
                         @elseif(Auth::user()->role=='agent')
                         <a href="{{route('agent')}}"class="nav-link" >Dashboard</a>
                         @elseif(Auth::user()->role=='merchant')
                         <a href="{{route('merchant')}}"class="nav-link" >Dashboard</a>
                         @else
                         {{-- <a href="{{route('userpofile')}}" class="nav-link">My Profile</a> --}}
                         <a href="{{route('logout')}}" class="nav-link"><b>Logout</b></a>
                         @endif
                     </li>
                     
                

                </ul>
            </div>
        </div>
    </nav>
 @yield('content')

    <footer class="footer ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="logo"><a href="#">Third Hand<span>.</span></a></h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-4">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Services</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Oil Change</a>
                            </li>
                            <li><a href="#" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Batteries</a>
                            </li>
                            <li><a href="#" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Tow Truck</a>
                            </li>
                            <li><a href="#" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Tire Change</a>
                            </li>
                            <li><a href="#" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Engine Repair</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Contact information</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text">House # 49, Road # 12, Sector # 11 Uttara - 1230, Dhaka, Bangladesh</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+8801716967050</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                                            class="text">info@thirdhand.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">COMPANY</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="text">About</span></li>
                                <li><span class="text">Contact us</span></li>
                                <li><a href="{{ route('terms_condition') }}"><span class="text">Terms & Condition</span></a></li>
                                <li><a href="{{ route('privacy_policy') }}"></span><span
                                            class="text">Privacy Policy</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script>| <a href="https://codewin.xyz" target="_blank" class="text">Codewin</a> 
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="{{asset('front_end/js/jquery.min.js')}}"></script>
    <script src="{{asset('front_end/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('front_end/js/popper.min.js')}}"></script>
    <script src="{{asset('front_end/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('front_end/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('front_end/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front_end/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('front_end/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{asset('front_end/js/google-map.js')}}"></script>
    <script src="{{asset('front_end/js/main.js')}}"></script>

</body>

</html>