<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from techydevs.com/demos/themes/html/trizen-demo/trizen/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Oct 2021 05:18:20 GMT -->
<?php $user_data = session()->get('user_data') ?>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SNCC TICKETS</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url()?>/assets/images/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/line-awesome.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/animated-headline.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<!-- start cssload-loader -->
<div class="preloader" id="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->
<!-- ================================
            START HEADER AREA
================================= -->
<header class="header-area">
    <div class="header-top-bar padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="justify-content-center text-center">
                        <a href="<?= base_url()?>">
                            <img src="<?= base_url()?>/assets/images/logo.png" style="width: 12%" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-wrapper padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-wrapper">
                        <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                        <div class="logo">
                            <ul class="list-items">
                                <li><a href="#"><i class="la la-phone mr-1"></i>snccs@contact.cd</a></li>
                            </ul>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div>
                        </div><!-- end logo -->
                        <div class="main-menu-content">
                            <nav>
                                <ul>
                                    <li style="margin-left: 0px!important; margin-right: 0px!important;">
                                        <a href="<?= base_url()?>">Accueil</a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('programs-trips')?>">Programmes</a>
                                    </li>

                                    <?php if (!empty($user_data)):?>
                                        <li>
                                            <a href="<?= base_url('dashboard')?>">Dashboard</i></a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url()?>/logout">Deconnexion</i></a>
                                        </li>
                                    <?php else:?>
                                        <li>
                                            <a href="<?= base_url()?>/login">Connexion</i></a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('register')?>">Inscription</i></a>
                                        </li>
                                    <?php endif;?>
                            </nav>
                        </div><!-- end main-menu-content -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-wrapper -->
</header>
<!-- ================================
         END HEADER AREA
================================= -->
<?= $this->renderSection('content')?>
<!-- ================================
       START FOOTER AREA
================================= -->
<section class="footer-area section-bg padding-top-100px padding-bottom-30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <div class="footer-logo padding-bottom-30px">
                        <a href="index.html" class="foot__logo">
                            <img src="<?= base_url()?>/assets/images/logo.png" style="width: 100%" alt="logo">
                        </a>
                    </div><!-- end logo -->
                    <p class="footer__desc">
                        Société Nationale de Chamin de fer au Congo
                    </p>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-1"></div>
            <div class="col-lg-5 responsive-column">
                <div class="footer-item">
                    <ul class="list-items pt-3">
                        <li>Lubumbashi, Ville Lubumbashi</li>
                        <li>+243 999 999 999</li>
                        <li><a href="#">contact@sncc.cd</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Autres liens</h4>
                    <ul class="list-items list--items">
                        <li><a href="#">Gerer votre réservation</a></li>
                        <li><a href="#">Packages</a></li>
                        <li><a href="#">Voyages</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="section-block mt-4"></div>
</section><!-- end footer-area -->
<!-- ================================
       START FOOTER AREA
================================= -->

<!-- start back-to-top -->
<div id="back-to-top">
    <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end back-to-top -->

<!-- end modal-shared -->
<div class="modal-popup">
    <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
                        <p class="font-size-14">Hello! Welcome Create a New Account</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post">
                            <div class="input-box">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your username">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <span class="la la-envelope form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your email">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Password</label>
                                <div class="form-group">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type password">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Repeat Password</label>
                                <div class="form-group">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type again password">
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box pt-3 pb-4">
                                <button type="button" class="theme-btn w-100">Register Account</button>
                            </div>
                            <div class="action-box text-center">
                                <p class="font-size-14">Or Sign up Using</p>
                                <ul class="social-profile py-3">
                                    <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                                    <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                                    <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal-popup -->


<!-- Template JS Files -->
<script src="<?= base_url()?>/assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url()?>/assets/js/jquery-ui.js"></script>
<script src="<?= base_url()?>/assets/js/popper.min.js"></script>
<script src="<?= base_url()?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?= base_url()?>/assets/js/moment.min.js"></script>
<script src="<?= base_url()?>/assets/js/daterangepicker.js"></script>
<script src="<?= base_url()?>/assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url()?>/assets/js/jquery.fancybox.min.js"></script>
<script src="<?= base_url()?>/assets/js/jquery.countTo.min.js"></script>
<script src="<?= base_url()?>/assets/js/animated-headline.js"></script>
<script src="<?= base_url()?>/assets/js/jquery.ripples-min.js"></script>
<script src="<?= base_url()?>/assets/js/quantity-input.js"></script>
<script src="<?= base_url()?>/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<?= $this->include("js_phpscript/jsPhp")?>
</body>

<!-- Mirrored from techydevs.com/demos/themes/html/trizen-demo/trizen/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Oct 2021 05:25:24 GMT -->
</html>