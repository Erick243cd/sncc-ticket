<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Afrinewsoft">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? "SNCC-TICKETS"?></title>
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
</head>
<body class="section-bg">
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
       START USER CANVAS MENU
================================= -->
<div class="user-canvas-container">
    <div class="side-menu-close">
        <i class="la la-times"></i>
    </div><!-- end menu-toggler -->
    <div class="user-canvas-nav">
        <div class="section-tab section-tab-2 text-center pt-4 pb-3 pl-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        Account
                    </a>
                </li>
            </ul>
        </div><!-- end section-tab -->
    </div>
    <div class="user-canvas-nav-content">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                <div class="user-sidebar-item">
                    <div class="notification-item">

                    </div><!-- end notification-item -->
                </div>
            </div>
            <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                <div class="user-action-wrap user-sidebar-panel">
                    <div class="notification-item">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm flex-shrink-0 mr-2"><img src="<?= base_url()?>/assets/images/users/<?= $user_data['user_picture']?>" alt="team-img"></div>
                                <span class="font-size-14 font-weight-bold"><?= $user_data['first_name']. ' '.$user_data['last_name'] ?></span>
                            </div>
                        </a>
                        <div class="list-group drop-reveal-list user-drop-reveal-list">
                            <a href="<?= base_url()?>/profile" class="list-group-item list-group-item-action">
                                <div class="msg-body">
                                    <div class="msg-content">
                                        <h3 class="title"><i class="la la-user mr-2"></i>Mon profile</h3>
                                    </div>
                                </div><!-- end msg-body -->
                            </a>
                            <a href="<?= base_url()?>/settings" class="list-group-item list-group-item-action">
                                <div class="msg-body">
                                    <div class="msg-content">
                                        <h3 class="title"><i class="la la-gear mr-2"></i>Settings</h3>
                                    </div>
                                </div><!-- end msg-body -->
                            </a>
                            <div class="section-block"></div>
                            <a href="<?= site_url('logout')?>" class="list-group-item list-group-item-action">
                                <div class="msg-body">
                                    <div class="msg-content">
                                        <h3 class="title"><i class="la la-power-off mr-2"></i>Logout</h3>
                                    </div>
                                </div><!-- end msg-body -->
                            </a>
                        </div>
                    </div><!-- end notification-item -->
                </div>
            </div>
        </div>
    </div>
</div><!-- end user-canvas-container -->
<!-- ================================
       END USER CANVAS MENU
================================= -->

<!-- ================================
       START DASHBOARD NAV
================================= -->
<div class="sidebar-nav">
    <div class="sidebar-nav-body">
        <div class="side-menu-close">
            <i class="la la-times"></i>
        </div><!-- end menu-toggler -->
        <div class="author-content">
            <div class="d-flex align-items-center">
                <div class="author-img avatar-sm">
                    <img src="<?= base_url()?>/assets/images/users/<?= $user_data['user_picture'] ?>" alt="testimonial image">
                </div>
                <div class="author-bio">
                    <h4 class="author__title"><?= $user_data['first_name']. ' '.$user_data['last_name'] ?></h4>
                    <span class="author__meta"> <?= ucfirst($user_data['user_role'])?></span>
                </div>
            </div>
        </div>
        <div class="sidebar-menu-wrap">
            <?php if ($user_data['user_role']==='traveller'):?>
            <ul class="sidebar-menu list-items">
                <li class="page-active"><a href="#"><i class="la la-dashboard mr-2"></i>Dashboard</a></li>
                <li><a href="<?= base_url()?>/profile"><i class="la la-shopping-cart mr-2 text-color"></i>Mes réservations</a></li>
                <li><a href="<?= base_url()?>/profile"><i class="la la-user mr-2 text-color-2"></i>Mon Profile</a></li>
                <li><a href="<?= base_url()?>"><i class="la la-shopping-cart mr-2 text-color"></i>Site web</a></li>
                <li><a href="<?= base_url() ?>/logout"><i class="la la-power-off mr-2 text-color-6"></i>Logout</a></li>
            </ul>
            <?php else:?>
            <ul class="sidebar-menu toggle-menu list-items">
                <li class="page-active"><a href="<?= base_url()?>/dashboard"><i class="la la-dashboard mr-2"></i>Dashboard</a></li>
                <li><a href="<?= base_url('booking-list') ?>"><i class="la la-shopping-cart mr-2 text-color"></i>Réservations</a></li>
                <li>
                    <span class="side-menu-icon toggle-menu-icon">
                        <i class="la la-angle-down"></i>
                    </span>
                    <a href="<?= base_url('trips')?>"><i class="la la-list mr-2 text-color-2"></i>Voyages</a>
                    <ul class="toggle-drop-menu">
                        <li><a href="<?= base_url('create-trip')?>">Nouveau voyage</a></li>
                        <li><a href="<?= base_url('trips')?>">Liste de voyages</a></li>
                    </ul>
                </li>
<!--                <li>-->
<!--                    <span class="side-menu-icon toggle-menu-icon">-->
<!--                        <i class="la la-angle-down"></i>-->
<!--                    </span>-->
<!--                    <a href="#"><i class="la la-map-signs mr-2 text-color-9"></i>Destination</a>-->
<!--                    <ul class="toggle-drop-menu">-->
<!--                        <li><a href="--><?//= base_url('cities')?><!--">Villes</a></li>-->
<!--                        <li><a href="--><?//= base_url('airlines')?><!--">Machines</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li><a href="<?= base_url()?>"><i class="la la-shopping-cart mr-2 text-color"></i>Site web</a></li>
                <li><a onclick="return confirm('Are you sure to logout ?');" href="<?= base_url()?>/logout"><i class="la la-power-off mr-2 text-color-11"></i>Logout</a></li>
            </ul>
            <?php endif;?>
        </div><!-- end sidebar-menu-wrap -->
    </div>
</div><!-- end sidebar-nav -->
<div class="container-fluid">
    <?= $this->renderSection('content')?>



<!-- start scroll top -->
<div id="back-to-top">
    <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->






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
<script src="<?= base_url()?>/assets/js/chart.js"></script>
<script src="<?= base_url()?>/assets/js/chart.extension.js"></script>
<script src="<?= base_url()?>/assets/js/bar-chart.js"></script
<script src="<?= base_url()?>/assets/js/jquery.ripples-min.js"></script>
<script src="<?= base_url()?>/assets/js/main.js"></script>
<?= $this->include('js_phpscript/jsPhp')?>
</body>
</html>