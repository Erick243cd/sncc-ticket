<?= $this->extend('layouts/dashboard')?>
<?= $this->section('content')?>
<!-- ================================
    START DASHBOARD AREA
================================= -->
<div class="dashboard-content-wrap">
        <div class="dashboard-main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">Flight details</h3>
                            </div>
                            <div class="form-content">
                                <ul class="list-items list-items-2 list-items-flush">
                                    <li class="font-weight-bold"><span>Trip ID#</span><?= $trip->trip_id?></li>
                                    <li><span>City From :</span><?= $city_from->city_name?> </li>
                                    <li><span>City To :</span><?= $trip->city_name?> </li>
                                    <li><span>Depart Date :</span> <?= date('d M Y', strtotime($trip->depart_date)) ?></li>
                                    <?php if($trip->trip_categorie ==="Round"):?>
                                        <li><span>Return Date :</span> <?= date('d M Y', strtotime($trip->return_date)) ?></li>
                                    <?php endif; ?>
                                    <li><span>Flight Category :</span> <?= $trip->trip_categorie ?></li>
                                    <li><span>Take Off :</span> <?= $trip->take_off ?></li>
                                    <li><span>Landing :</span> <?= $trip->landing ?></li>
                                    <li><span>Total Time :</span> <?= $trip->total_time ?></li>
                                    <li class="text-primary"><span>Airline:</span>  <?= $trip->airline_name ?></li>
                                    <li class="text-danger"><span>Business :</span>   $ <?= number_format($trip->fixed_price_business_class, 2,'.','')?></li>
                                    <li class="text-danger"><span>Economic :</span>   $ <?= number_format($trip->fixed_price_economic_price, 2,'.','')?></li>
                                    <li class="text-danger"><span>Premium :</span>   $ <?= number_format($trip->fixed_price_premium_class, 2,'.','')?></li>

                                    <li class="text-danger"><span>First :</span>   $ <?= number_format($trip->fixed_price_first_class, 2,'.','')?></li>
                                    <li class="text-danger"><span>Child price Business :</span>   $ <?= number_format($trip->fixed_price_child_business, 2,'.','')?></li>
                                    <li class="text-danger"><span>Child price First :</span>   $ <?= number_format($trip->fixed_price_child_first, 2,'.','')?></li>
                                    <li class="text-danger"><span>Child price Economic :</span>   $ <?= number_format($trip->fixed_price_child_economic, 2,'.','')?></li>
                                    <li class="text-danger"><span>Child price Premium :</span>   $ <?= number_format($trip->fixed_price_child_premium, 2,'.','')?></li>

                                    <li class="text-danger"><span>Infant price :</span>   $ <?= number_format($trip->fixed_price_infant, 2,'.','')?></li>

                                    <li><span>Total Time :</span> <?=($trip->trip_status==1) ? "Active":"Inactive" ?></li>
                                </ul>
                                <hr>
                                <div class="col-lg-12">
                                    <p class="text-wrap">  <?= $trip->conditions ?></p>
                                </div>
                                <div class="btn-box mt-4">
                                    <?php if ($trip->trip_status ==1): ?>
                                        <a href="<?= base_url('trips/desactivate/'.$trip->trip_id)?>" class="theme-btn theme-btn-small"><i class="la la-envelope mr-1"></i>Desactivate</a>
                                    <?php else:?>
                                        <a href="<?= base_url('trips/activate/'.$trip->trip_id)?>" class="theme-btn theme-btn-small"><i class="la la-envelope mr-1"></i>Activate</a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div><!-- end form-box -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="border-top mt-5"></div>
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="copy-right padding-top-30px">
                            <p class="copy__desc">
                                &copy; Copyright Trizen 2020. Made with
                                <span class="la la-heart"></span> by <a href="https://themeforest.net/user/techydevs/portfolio">TechyDevs</a>
                            </p>
                        </div><!-- end copy-right -->
                    </div><!-- end col-lg-7 -->
                    <div class="col-lg-5">
                        <div class="copy-right-content text-right padding-top-30px">
                            <ul class="social-profile">
                                <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                <li><a href="#"><i class="lab la-linkedin-in"></i></a></li>
                            </ul>
                        </div><!-- end copy-right-content -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end dashboard-main-content -->
</div>
<!-- ================================
    END DASHBOARD AREA
================================= -->
<?= $this->endSection()?>
