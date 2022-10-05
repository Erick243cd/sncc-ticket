<?= $this->extend("layouts/website")?>
<?= $this->section("content")?>
<!--Space Of initialize-->
<?php
helper('form');
$totalPrices = session()->get('totalPrices');
$amount_base =  null;
?>
    <!-- ================================
    START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area bread-bg-6">
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title text-white">Information de la réservation</h2>
                            </div>
                        </div><!-- end breadcrumb-content -->
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-right">
                            <ul class="list-items">
                                <li><a href="index.php">Accueil</a></li>
                                <li>Information de la réservation</li>
                            </ul>
                        </div><!-- end breadcrumb-list -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end breadcrumb-wrap -->
        <div class="bread-svg-box">
            <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"><polygon points="100 0 50 10 0 0 0 10 100 10"></polygon></svg>
        </div><!-- end bread-svg -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
        START BOOKING AREA
    ================================= -->
    <section class="booking-area padding-top-100px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-box booking-detail-form">
                        <div class="form-title-wrap">
                            <h3 class="title">Infos de la réservation</h3>
                        </div><!-- end form-title-wrap -->
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3 class="card-title"><?= ucfirst($cityfrom->city_name )." à ". ucfirst($cityto->city_name ) ?> </h3>

                                        </div>
                                    </div>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 list-items-flush py-2">
                                        <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-calendar mr-1 font-size-17"></i>Date départ</span><?= $cityto->depart_date ?></li>
                                    </ul>
                                    <h3 class="card-title pb-3">Détails</h3>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 py-3">
                                        <li><span>Machine: </span><?= ucfirst($cityto->airline_name) ?></li>
                                    </ul>
                                    <h3 class="card-title pb-3">Passagers</h3>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 py-3">
                                        <li><span>Adultes : </span><?= $_POST['aldult_number']?></li>
                                        <li><span>Enfants : </span><?= $_POST['child_number'] ?></li>
                                        <li><span>Bébés : </span><?= $_POST['infants_number'] ?></li>
                                    </ul>
                                    <!-- Space For Operations-->

                                </div>
                            </div><!-- end card-item -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-8">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Methode de paiement</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="section-tab check-mark-tab text-center pb-4">
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="payoneer-tab" data-toggle="tab" href="#payoneer" role="tab" aria-controls="payoneer" aria-selected="true">
                                            <i class="la la-check icon-element"></i>
                                            <img src="<?= base_url()?>/assets/images/mobilemoney.jpg" alt="">
                                            <span class="d-block pt-2">Mobile Money</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="credit-card-tab" data-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="false">
                                            <i class="la la-check icon-element"></i>
                                            <img src="<?= base_url()?>/assets/images/payment-img.png" alt="">
                                            <span class="d-block pt-2">Carte crédit</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="true">
                                            <i class="la la-check icon-element"></i>
                                            <img src="<?= base_url()?>/assets/images/paypal.png" alt="">
                                            <span class="d-block pt-2">PayPal</span>
                                        </a>
                                    </li>

                                </ul>
                            </div><!-- end section-tab -->
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="payoneer" role="tabpanel" aria-labelledby="payoneer-tab">
                                    <div class="contact-form-action">
                                        <?= form_open('booktrip')?>
                                            <div class="row">
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">M-PESA</label>
                                                        <div class="form-group">
                                                            <span class="la la-phone form-icon text-danger"></span>
                                                            <input class="form-control" disabled type="text" name="phone" placeholder="022-222-5652">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Nom Agent</label>
                                                        <div class="form-group">
                                                            <span class="la la-user form-icon text-success"></span>
                                                            <input disabled class="form-control" type="text" name="text" placeholder="SNCC-TICKETS">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->

                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">AIRTEL MONEY</label>
                                                        <div class="form-group">
                                                            <span class="la la-phone form-icon text-danger"></span>
                                                            <input class="form-control" disabled type="text" name="phone" placeholder="7007">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Nom Agent</label>
                                                        <div class="form-group">
                                                            <span class="la la-user form-icon text-success"></span>
                                                            <input disabled class="form-control" type="text" name="text" placeholder="SNCC TICKETS">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-12 responsive-column" >
                                                    <div class="input-box">
                                                        <label class="label-text">Coller votre id de transaction.</label>
                                                        <div class="form-group">
                                                            <span class="la la-user form-icon text-success"></span>
                                                            <input class="form-control" type="text" name="transact_id" placeholder="ex. Trans.ID:CO210806.1848.C18716" value="Trans.ID:CO210806.1848.C18716" required>
                                                            <input class="form-control" type="hidden" name="transact_mode" value="mobile money" required>
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->

                                                <input type="hidden" value="<?= $_POST['trip_id']?>" name="trip_id">
                                                <input type="hidden" value="<?= $_POST['infants_number']?>" name="infants_number">
                                                <input type="hidden" value="<?= $_POST['aldult_number']?>" name="adult_number">
                                                <input type="hidden" value="<?= $_POST['child_number']?>" name="child_number">


                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit" onclick="$('#sending_process').fadeIn(1500)">Confirmer maintenant</button>
                                                    </div>
                                                    <div class="alert alert-primary alert-dismissible fade show mt-3" id="sending_process" role="alert" style="display: none" >
                                                        <i class="la la-check mr-2"></i> Sending order,  Please wait...
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                </div><!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div><!-- end contact-form-action -->
                                </div><!-- end tab-pane-->

                                <div class="tab-pane fade" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">
                                    <div class="contact-form-action">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Card Holder Name</label>
                                                        <div class="form-group">
                                                            <span class="la la-credit-card form-icon"></span>
                                                            <input class="form-control" type="text" name="text" placeholder="Card holder name">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Card Number</label>
                                                        <div class="form-group">
                                                            <span class="la la-credit-card form-icon"></span>
                                                            <input class="form-control" type="text" name="text" placeholder="Card number">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6 responsive-column">
                                                            <div class="input-box">
                                                                <label class="label-text">Expiry Month</label>
                                                                <div class="form-group">
                                                                    <span class="la la-credit-card form-icon"></span>
                                                                    <input class="form-control" type="text" name="text" placeholder="MM">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 responsive-column">
                                                            <div class="input-box">
                                                                <label class="label-text">Expiry Year</label>
                                                                <div class="form-group">
                                                                    <span class="la la-credit-card form-icon"></span>
                                                                    <input class="form-control" type="text" name="text" placeholder="YY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">CVV</label>
                                                        <div class="form-group">
                                                            <span class="la la-pencil form-icon"></span>
                                                            <input class="form-control" type="text" name="text" placeholder="CVV">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->


                                                <input type="hidden" value="<?= $_POST['trip_id']?>" name="trip_id">
                                                <input type="hidden" value="<?= $_POST['infants_number']?>" name="infants_number">
                                                <input type="hidden" value="<?= $_POST['aldult_number']?>" name="adult_number">
                                                <input type="hidden" value="<?= $_POST['child_number']?>" name="child_number">


                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">Confirmer la réservation</button>
                                                    </div>
                                                </div><!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div><!-- end contact-form-action -->
                                </div><!-- end tab-pane-->
                                <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                                    <div class="contact-form-action">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Email Address</label>
                                                        <div class="form-group">
                                                            <span class="la la-envelope form-icon"></span>
                                                            <input class="form-control" type="email" name="email" placeholder="Enter email address">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">Password</label>
                                                        <div class="form-group">
                                                            <span class="la la-lock form-icon"></span>
                                                            <input class="form-control" type="text" name="text" placeholder="Enter password">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">S'authentifier</button>
                                                    </div>
                                                </div><!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div><!-- end contact-form-action -->
                                </div><!-- end tab-pane-->

                            </div><!-- end tab-content -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end booking-area -->
    <!-- ================================
        END BOOKING AREA
    ================================= -->
<?= $this->endSection()?>
