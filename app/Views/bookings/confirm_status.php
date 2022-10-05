<?= $this->extend("layouts/website") ?>
<?= $this->section("content") ?>
<?php helper('text'); ?>
<!-- ================================
START PAYMENT AREA
================================= -->
<section class="payment-area section-bg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-box payment-received-wrap mb-0">
                    <div class="form-title-wrap">
                        <div class="step-bar-wrap text-center">
                            <ul class="step-bar-list d-flex align-items-center justify-content-around">
                                <li class="step-bar flex-grow-1 step-bar-active">
                                    <span class="icon-element">1</span>
                                    <p class="pt-2 color-text-2">Recherche et sélection</p>
                                </li>
                                <li class="step-bar flex-grow-1 step-bar-active">
                                    <span class="icon-element">2</span>
                                    <p class="pt-2 color-text-2">Votre réservation et paiement</p>
                                </li>
                                <li class="step-bar flex-grow-1  step-bar-active">
                                    <span class="icon-element">3</span>
                                    <p class="pt-2 color-text-2">Confirmation (Confirmed)</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-received-list">
                                    <h3 class="title font-size-22 mb-1">PINR : <?= $booking->bk_token?></h3>
                                    <h4 class="title font-size-18"><?= $booking->airline_name?></h4>

                                    <ul class="list-items list-items-2 py-3">
                                        <li><span>Provenance :</span><?= $from->city_name?></li>
                                        <li><span>Destination:</span><?= $booking->city_name?></li>
                                        <li><span>Date départ date :</span><?= date('d, M Y', strtotime($booking->depart_date))?></li>
                                        <li><span>Passagers:</span><?= $booking->bk_nb_adult?> Adults, <?= $booking->bk_nb_child?> Childrens,  <?= $booking->bk_nb_infant?> Infants</li>
                                        <li><span>Client:</span><?= $booking->first_name . ' '.$booking->last_name ?></li>
                                    </ul>
                                </div><!-- end card-item -->
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="card-item card-item-list payment-received-card">
                                    <div class="card-body">
                                        <h3 class="card-title"><?= $booking->city_name?></h3>
                                        <div class="card-price pb-3">
                                            <span class="price__from">From</span>
                                            <span class="price__num"><?= $from->city_name?></span>
                                        </div>
                                        <div class="section-block"></div>
                                        <p class="card-text pt-3"> <strong><?= $booking->airline_name?> </strong> <?= word_limiter($booking->airline_description, 15)?></p>
                                    </div>
                                </div><!-- end card-item -->
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-received-list">
                                    <div class="table-form table-responsive pt-3 pb-3">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Book ID</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">#<?= $booking->bk_token ?></th>
                                                <td>
                                                    <div class="table-content">
                                                        <h3 class="title"><?=date("D d M, Y", strtotime($booking->booking_date)) ?></h3>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="text-success">Votre commande est confirmée, vous pouvez désormais vous servir du code PNR ci-dessus pour toute opération de contrôle </p>
                                </div><!-- end card-item -->
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-12">
                                <div class="section-block mt-3"></div>
                                <div class="btn-box text-center pt-4">
                                    <a href="<?= base_url()?>/profile" class="theme-btn">Retour</a>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div>
                </div><!-- end payment-card -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<!-- ================================
    END PAYMENT AREA
================================= -->
<?= $this->endSection() ?>

