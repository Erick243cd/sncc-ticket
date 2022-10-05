<?= $this->extend("layouts/website") ?>
<?= $this->section("content") ?>
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
                            <h2 class="sec__title text-white">Programme de voyages</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li><a href="<?= base_url() ?>">Accueil</a></li>
                            <li>Programme de voyages</li>
                        </ul>
                    </div><!-- end breadcrumb-list -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
    <div class="bread-svg-box">
        <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
            <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
        </svg>
    </div><!-- end bread-svg -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START CARD AREA
================================= -->
<section class="card-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <h3 class="title font-size-24"><?= (count($trips) > 1) ? count($trips) . " Voyages trouvés" : count($trips) . " Voyage trouvé" ?> </h3>
                            <p class="font-size-14"><span class="mr-1 pt-1">Réserver en toute sécurité</span></p>
                        </div>
                        <div class="layout-view d-flex align-items-center">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><i
                                        class="la la-th-large"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="List View"><i
                                        class="la la-th-list"></i></a>
                        </div>
                    </div><!-- end filter-top -->
                </div><!-- end filter-wrap -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php foreach ($trips as $trip): ?>
                        <div class="col-lg-6 responsive-column">
                            <div class="card-item flight-card flight--card">
                                <div class="card-img">
                                    <img src="<?= base_url() ?>/assets/images/airlines/airline-img7.jpeg" alt="flight-logo-img" style="width: 100%; height: 100%">
                                </div>
                                <div class="card-body">
                                    <div class="card-top-title d-flex justify-content-between">
                                        <div>
                                            <h3 class="card-title font-size-17">Destination : <?= ucfirst($trip->city_name) ?></h3>
                                        </div>
                                        <div>
                                            <div class="text-right">
                                                <span class="font-weight-regular font-size-14 d-block">Date de départ</span>
                                                <h6 class="font-weight-bold color-text"><?= date('m-d-Y', strtotime($trip->depart_date)) ?></h6>
                                            </div>
                                        </div>
                                    </div><!-- end card-top-title -->
                                    <div class="flight-details py-3">

                                    </div><!-- end flight-details -->
                                    <div class="btn-box text-center">
                                        <a href="<?= site_url('viewTripDetails/'.$trip->trip_id)?>"
                                           class="theme-btn theme-btn-small w-100">Voir les détails</a>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card-item -->
                        </div>
                    <?php endforeach; ?>
                </div><!-- end row -->
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end card-area -->
<!-- ================================
    END CARD AREA
================================= -->
<?= $this->endSection("content") ?>
