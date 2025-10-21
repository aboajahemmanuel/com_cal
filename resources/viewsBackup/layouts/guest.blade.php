<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insuco || Insurance Company Template</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('guest/assets/images/favicons/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('guest/assets/images/favicons/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('guest/assets/images/favicons/favicon-16x16.png')}}" />
    <link rel="manifest" href="{{ asset('guest/assets/images/favicons/site.html')}}" />
    <!-- fonts css -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;1,400;1,500&amp;family=Red+Hat+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/animate/animate.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/insuco-icons/flaticon_insuco.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/jquery-nice-select/css/nice-select.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/owl-carousel/dist/assets/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/owl-carousel/dist/assets/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{ asset('guest/assets/vendors/youtube-popup/youtube-popup.css')}}" />
    <!-- template css -->
    <link rel="stylesheet" href="{{ asset('guest/assets/css/insuco.css')}}" />

	<link rel="stylesheet" href="{{ asset('/admin/assets/css/dashlite.css')}}">
    <link  rel="stylesheet" href="{{ asset('/admin/assets/css/theme.css')}}">

{{-- 	
    <link rel="stylesheet" href="admin/{{ asset('assets/css/dashlite.css')}}">
    <link rel="stylesheet" href="admin/{{ asset('assets/css/theme.css')}}"> --}}
</head>

<body>
    <div class="preloader">
        <div class="preloader__inner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- /.preloader__inner -->
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
        <header class="main-header" style=" background-color: red !important;">

            <!-- /.topbar-one -->
            <div class="main-header__middle">
                <!-- <div> -->
                <div class="container">
                    <div class="main-header__left">
                        <a href="index.html" class="main-header__logo">
                            <img src="{{ asset('guest/assets/images/logo.png')}}" width="200px" height="60px" alt="" />
                        </a>
                        <a href="#" class="main-header__toggler mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                    <!-- /.main-header__left -->

                    <!-- /.list-unstyled main-header__info -->
                </div>
                <!-- /.container -->
            </div>


        </header>


            @yield('content')




<!-- /.testimonials-one -->

<footer class="footer-one">


    <!-- /.footer-one__middle -->
    <div class="footer-one__bottom">
        <div class="container">
            <div class="footer-one__bottom__inner">
                <a href="#" data-target="html" class="scroll-to-target footer-one__bottom__scroll"><i class="far fa-arrow-alt-up"></i></a>
                <ul class="footer-one__bottom__menu list-unstyled">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li>
                        <a href="portfolio-grid.html">Setting</a>
                    </li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="faqs.html">Faqs</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <!-- /.footer-one__bottom__menu list-unstyled -->
                <p class="footer-one__bottom__copyright">
                    Copyright ©
                    <span class="dynamic-year"></span> FMDQ GROUP , All
                    rights Reserved
                </p>
                <!-- /.footer-one__bottom__copyright -->
            </div>
            <!-- /.footer-one__bottom__inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.footer-one__bottom -->
</footer>
<!-- /.footer-one -->
</div>
<!-- /.page-wrapper -->

<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <a href="#" class="mobile-nav__close mobile-nav__toggler">
            <span></span>
            <span></span>
        </a>

        <div class="logo-box">
            <a href="index.html" aria-label="logo image"><img src="{{ asset('guest/assets/images/logo-light.png')}}" alt="Insuco" /></a>
        </div>
        <!-- /.logo-box -->
        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="list-unstyled footer-one__widget__contact">
            <li>
                <i class="far fa-envelope-open"></i>
                <a href="mailto:support@gmail.com">support@gmail.com</a>
            </li>
            <li>
                <i class="far fa-phone-plus"></i>
                <a href="tel:+000(123)45688">+000 (123) 456 88</a>
            </li>
        </ul>
        <!-- /.list-unstyled -->

        <ul class="list-unstyled footer-one__widget__social">
            <li>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
        <!-- /.list-unstyled footer-one__widget__social -->
    </div>
    <!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<div class="side-drawer__wrapper">
    <div class="side-drawer__overlay side-drawer__toggler"></div>
    <!-- /.side-drawer__overlay -->
    <div class="side-drawer__content">
        <a href="#" class="side-drawer__close side-drawer__toggler">
            <span></span>
            <span></span>
        </a>

        <div class="logo-box">
            <a href="index.html" aria-label="logo image"><img src="{{ asset('guest/assets/images/logo-light.png')}}" alt="Insuco" /></a>
        </div>
        <!-- /.logo-box -->
        <div class="footer-one__widget">
            <h3 class="footer-one__widget__title">About</h3>
            <!-- /.footer-one__widget__title -->
            <p class="footer-one__widget__text">
                We denounce righteous indignations dislike men beguiled
                and demoralized charms of pleasure moment
            </p>
            <!-- /.footer-one__widget__text -->

            <ul class="list-unstyled footer-one__widget__social">
                <li>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </li>
            </ul>
            <!-- /.list-unstyled footer-one__widget__social -->
        </div>
        <!-- /.footer-one__widget -->
        <div class="footer-one__widget">
            <h3 class="footer-one__widget__title">Gallery</h3>
            <!-- /.footer-one__widget__title -->
           
            <!-- /.list-unstyled -->
        </div>
        <!-- /.footer-one__widget -->

        <div class="footer-one__widget">
            <h3 class="footer-one__widget__title">Contact</h3>

            <ul class="list-unstyled footer-one__widget__contact">
                <li>
                    <i class="far fa-envelope-open"></i>
                    <a href="mailto:support@gmail.com">support@gmail.com</a>
                </li>
                <li>
                    <i class="far fa-phone-plus"></i>
                    <a href="tel:+000(123)45688">+000 (123) 456 88</a>
                </li>
            </ul>
            <!-- /.list-unstyled -->
        </div>
        <!-- /.footer-one__widget -->
    </div>
    <!-- /.side-drawer__content -->
</div>
<!-- /.side-drawer__wrapper -->

<!-- plugin js -->
<script src="{{ asset('guest/assets/vendors/jquery/jquery-3.6.1.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/jquery-validated/jquery.validate.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/owl-carousel/dist/owl.carousel.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/jquery-appear/jquery.appear.min.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/youtube-popup/youtube-popup.jquery.js')}}"></script>
<script src="{{ asset('guest/assets/vendors/wow/wow.js')}}"></script>
<!-- template js -->
<script src="{{ asset('guest/assets/js/insuco.js')}}"></script>
<script src="{{ asset('admin/assets/js/bundle.js')}}"></script>

<script src="{{ asset('admin/assets/js/scripts.js')}}"></script>
</body>

</html>