<?= $this->extend('layouts/dashboard')?>
<?= $this->section('content')?>
<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    <div class="dashboard-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-wrapper">
                        <div class="logo mr-5">
                            <a href="<?= site_url() ?>"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div><!-- end menu-toggler -->
                            <div class="user-menu-open">
                                <i class="la la-user"></i>
                            </div><!-- end user-menu-open -->
                        </div>

                        <div class="nav-btn ml-auto">
                            <div class="notification-wrap d-flex align-items-center">
                                <div class="notification-item">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="userDropdownMenu" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm flex-shrink-0 mr-2"><img
                                                            src="<?= base_url() ?>/assets/images/users/<?= $user_data['user_picture'] ?>"
                                                            alt="team-img"></div>
                                                <span class="font-size-14 font-weight-bold"><?= $user_data['first_name'] . ' ' . $user_data['last_name'] ?></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-reveal dropdown-menu-md dropdown-menu-right">
                                            <div class="list-group drop-reveal-list user-drop-reveal-list">
                                                <a href="<?= base_url() ?>/profile"
                                                   class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="la la-user mr-2"></i>Mon profile
                                                            </h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                                <div class="section-block"></div>
                                                <a href="<?= base_url() ?>/logout"
                                                   class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="la la-power-off mr-2"></i>Logout
                                                            </h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                            </div>
                                        </div><!-- end dropdown-menu -->
                                    </div>
                                </div><!-- end notification-item -->
                            </div>
                        </div><!-- end nav-btn -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div>
<div class="dashboard-content-wrap">
    <div class="dashboard-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Détails de la réservation</h3>
                        </div>
                        <div class="form-content">
                            <ul class="list-items list-items-2 list-items-flush">
                                <li class="font-weight-bold"><span>PINR #</span><?= $booking->bk_token?></li>
                                <li class="font-weight-bold"><span>Date réservation </span><?= $booking->booking_date ?></li>

                                <li><span>Client :</span><?= $booking->first_name .' '.$booking->last_name  ?></li>
                                <li><span>Provenance  :</span><?= $from->city_name?> </li>
                                <li><span>Destination :</span><?= $booking->city_name?> </li>
                                <li><span>Date de départ :</span> <?= date('d M Y', strtotime($booking->depart_date)) ?></li>

                                <li><span>Adultes :</span> <?= $booking->bk_nb_adult ?></li>
                                <li><span>Enfants :</span> <?= $booking->bk_nb_child ?></li>
                                <li><span>Bébés :</span> <?= $booking->bk_nb_infant ?></li>
                                <li><span>Status :</span> <?= $booking->bk_status ?></li>

                                <li><span>Heure départ :</span> <?= $booking->take_off ?></li>
                                <li class="text-primary"><span>Machine:</span>  <?= $booking->airline_name ?></li>

                            </ul>
                            <hr>
                        </div>
                    </div><!-- end form-box -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            <div class="border-top mt-5"></div>
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-main-content -->
</div>
</section>
<!-- ================================
    END DASHBOARD AREA
================================= -->
<?= $this->endSection()?>

