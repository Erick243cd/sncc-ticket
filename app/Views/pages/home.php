<?= $this->extend("layouts/website")?>
<?= $this->section("content")?>
<?php helper('form');?>
<!-- ================================
    START HERO-WRAPPER AREA
================================= -->
<section class="hero-wrapper" style="margin-bottom: 0px!important;">
    <div class="hero-box hero-bg">
        <span class="line-bg line-bg1"></span>
        <span class="line-bg line-bg2"></span>
        <span class="line-bg line-bg3"></span>
        <span class="line-bg line-bg4"></span>
        <span class="line-bg line-bg5"></span>
        <span class="line-bg line-bg6"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto responsive--column-l">
                    <div class="hero-content pb-5">
                        <div class="section-heading">
                            <h2 class="sec__title cd-headline zoom">
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">
                                        Faites votre réseravation
                                    </b>
                                    <b>
                                        Achetez le billet
                                    </b>
                                    <b>
                                        Voyagez en toute sécurité
                                    </b>
                                    <b>
                                        Parcourez le pays
                                    </b>
                                </span>
                            </h2>
                        </div>
                    </div><!-- end hero-content -->
                    <div class="section-tab text-center pl-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" href="<?= site_url("programs-trips")?>" aria-selected="true">
                                    <i class="la la-calendar mr-1"></i>Programme de voyages
                                </a>
                            </li>
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link d-flex align-items-center" id="package-tab" data-toggle="tab" href="#package" role="tab" aria-controls="package" aria-selected="false">-->
<!--                                    <i class="la la-shopping-bag mr-1"></i>Vacation Packages-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link d-flex align-items-center" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false">-->
<!--                                    <i class="la la-shopping-bag mr-1"></i>Manage Your Booking-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </div><!-- end section-tab -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path></svg>
    </div>
</section><!-- end hero-wrapper -->
<!-- ================================
    END HERO-WRAPPER AREA
================================= -->

<!-- ================================
       START CLIENTLOGO AREA
================================= -->
<?= $this->endSection()?>

