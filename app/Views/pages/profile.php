<?=  $this->extend("layouts/website")?>
<?=  $this->section("content")?>

<!-- ================================
    START USER AREA
================================= -->
<section class="user-area padding-top-100px padding-bottom-60px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="title font-size-24">Information client</h3>
                <?php if (session()->getFlashdata('success')):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="la la-check mr-2"></i><?= session()->getFlashdata('success')?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card-item user-card card-item-list mt-4 mb-0">
                    <div class="card-img">
                        <img src="<?= base_url()?>/assets/images/users/<?=$user_data['user_picture']?>" alt="user image">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><?= $user_data['first_name'] .' '. $user_data['last_name']?></h3>
                        <p class="card-meta">Client depuis <?= date("M Y", strtotime($user_data['user_created_at'])) ?></p>
                        <div class="d-flex justify-content-between">
                            <ul class="list-items list-items-2 flex-grow-1">
                                <li><span>Email:</span><?= $user_data['user_email'] ?></li>
                                <li><span>Téléphone:</span><?= $user_data['phone_number'] ?></li>
                                <li><span>Paiement Email:</span><?= $user_data['user_email'] ?></li>
                                <li><span>Adresse de départ:</span><?= $user_data['home_airport'] ?? "" ?></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-70px">
            <div class="col-lg-9">
                <h3 class="title font-size-24">Services du client</h3>
                <div class="section-tab section-tab-3 pt-4 pb-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="my-flight-tab" data-toggle="tab" href="#my-flight" role="tab" aria-controls="my-flight" aria-selected="false">
                                Réservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="my-review-tab" data-toggle="tab" href="#my-review" role="tab" aria-controls="my-review" aria-selected="false">
                                Historique
                            </a>
                        </li>
                    </ul>
                </div><!-- end section-tab -->
                <div class="tab-content margin-bottom-40px" id="myTabcontent">

                    <div class="tab-pane fade " id="my-hotel" role="tabpanel" aria-labelledby="my-hotel-tab">
                        <div class="my-service-list">

                        </div><!-- end my-service-list -->

                    </div><!-- end tab-pane -->

                    <div class="tab-pane fade show active" id="my-flight" role="tabpanel" aria-labelledby="my-flight-tab">
                        <div class="my-service-list">
                            <?php if (empty($bookings)) :?>
                                <h3 class="title font-size-24 text-warning text-center">Vous n'avez aucune réservation </h3>
                            <?php else:?>
                            <?php foreach ($bookings as $booking ) :?>
                                    <div class="card-item flight-card flight--card card-item-list card-item-list-2">
                                        <div class="card-body">
                                            <div class="card-top-title d-flex justify-content-between">
                                                <div>
                                                    <h3 class="card-title font-size-17">Code ticket <?= ucfirst($booking->bk_token)?> </h3>
                                                    <p class="card-meta font-size-14"><?= $booking->trip_categorie?> flight</p>
                                                </div>
                                            </div><!-- end card-top-title -->
                                            <ul class="list-items list-items-2 py-2">
                                                <li><span>Machine:</span><?= ucfirst($booking->airline_name)?></li>
                                                <li><span>Date de départ : </span><?= date("d M, Y", strtotime($booking->depart_date)) ?></li>
                                                <li><span>Heure de départ:</span><?= $booking->take_off ?></li>
                                            </ul>
                                            <div class="btn-box text-center">
                                                <a href="<?= base_url('booking-status/'.$booking->booking_id) ?>" class="theme-btn theme-btn-small w-100">Voir le Statut</a>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card-item -->
                            <?php endforeach;?>
                            <?php endif;?>
                        </div><!-- end my-service-list -->

                    </div><!-- end tab-pane -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="review-summary mt-2 section-bg">
                    <p>Réservations</p>
                    <h2><?= count($bookings) ?? "0"?><span></span></h2>
                </div><!-- end review-summary -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end user-area -->
<!-- ================================
    END USER AREA
================================= -->


<!-- ================================
       START FOOTER AREA
================================= -->
<!-- ================================

<?=  $this->endSection()?>
