<?= $this->extend("layouts/website")?>
<?= $this->section("content")?>
<?php
    helper('form');
    $totalPrices = session()->get('totalPrices');
?>
<!-- ================================
START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg-9">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title text-white">Destination</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li>Details</li>
                            <li>Provenance : <?=  $from->city_name ?? "" ?></li>
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
    START TOUR DETAIL AREA
================================= -->

<section class="tour-detail-area padding-bottom-90px">
    <div class="single-content-navbar-wrap menu section-bg" id="single-content-navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content-nav" id="single-content-nav">
                        <ul>
                            <li><a data-scroll="description" href="#description" class="scroll-link active">Détails du voyage</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end single-content-navbar-wrap -->
    <div class="single-content-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-content-wrap padding-top-60px">
                        <div id="description" class="page-scroll">
                            <div class="single-content-item pb-4">
                                <h3 class="title font-size-26">Destination : <?=  $trip->city_name ?></h3>

                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>

                            <div class="section-block"></div>
                            <div class="single-content-item padding-top-40px padding-bottom-40px">
                                <h3 class="title font-size-20">Machine :  <?=  ucfirst($trip->airline_name) ?></h3>
                                <p class="py-3">
                                    <?=  ucfirst($trip->airline_description) ?></p>
                              </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div><!-- end description -->

                    </div><!-- end single-content-wrap -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar single-content-sidebar mb-0">
                        <?= form_open('booking-trip')?>
                        <input type="hidden" value="<?= $trip->trip_id?>" name="trip_id">
                            <div class="sidebar-widget single-content-widget">
                            <div class="sidebar-widget-item">
                                <div class="sidebar-book-title-wrap mb-3">
                                    <h3>Compléter</h3>
                                </div>
                            </div><!-- end sidebar-widget-item -->
                            <div class="sidebar-widget-item">
                                <div class="contact-form-action">
                                    <form action="#">
                                        <div class="input-box">
                                            <label class="label-text">Date de départ</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class=" form-control" type="date" value="<?= $trip->depart_date?>" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- end sidebar-widget-item -->
                            <div class="sidebar-widget-item">
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <label class="font-size-16">Adultes <span>Age 18+</span></label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <input type="number" style="width: max-content; border: 1px solid gray; border-radius: 5px" name="aldult_number" value="1" min="1" required>
                                    </div>
                                </div><!-- end qty-box -->
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <label class="font-size-16">Enfants <span>2-12 ans</span></label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <input type="number" name="child_number" style="width: max-content; border: 1px solid gray; border-radius: 5px" name="aldult_number" value="0" min="0" required>
                                    </div>
                                </div><!-- end qty-box -->
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <label class="font-size-16">Enfants <span>0-2 ans</span></label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <input type="number" name="infants_number" style="width: max-content; border: 1px solid gray; border-radius: 5px" name="aldult_number" value="0" min="0" required>
                                    </div>
                                </div><!-- end qty-box -->
                            </div><!-- end sidebar-widget-item -->
                            <div class="btn-box pt-2">
                                <?php if (isset($user_data)):?>
                                     <button type="submit" class="theme-btn text-center w-100 mb-2"><i class="la la-shopping-cart mr-2 font-size-18"></i>Réserver Maintenant</button>
                                <?php else :?>
                                    <a href="<?= base_url()?>/logandbook" class="theme-btn text-center w-100 mb-2"><i class="la la-shopping-cart mr-2 font-size-18"></i>Connectez-vous ou inscrivez-vous pour réserver</a>
                                <?php endif;?>
                            </div>
                        </div><!-- end sidebar-widget -->
                       <?= form_close()?>
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end single-content-box -->
</section><!-- end tour-detail-area -->
<!-- ================================
    END TOUR DETAIL AREA
================================= -->

<div class="section-block"></div>

<!-- ================================

================================= -->
<?= $this->endSection()?>
