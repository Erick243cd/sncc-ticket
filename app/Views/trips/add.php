<?= $this->extend("layouts/dashboard") ?>
<?= $this->section("content") ?>
<?php helper('form'); ?>
<!-- ================================
    START FORM AREA
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
    <div class="dashboard-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title"><i class="la la-gear mr-2 text-gray"></i>Nouveau voyage
                            </h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content contact-form-action">
                            <?= form_open('create-trip', 'class="row"') ?>
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Provenance</label>
                                    <div class="form-group select-contain w-100">
                                        <select class="select-contain-select" name="city_from">
                                            <?php foreach ($cities as $row): ?>
                                                <option value="<?= $row->city_id ?>" <?= set_select('city_from', $row->city_id) ?>><?= $row->city_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['city_from'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Destination</label>
                                    <div class="form-group select-contain w-100">
                                        <select class="select-contain-select" name="city_to">
                                            <?php foreach ($cities as $row): ?>
                                                <option value="<?= $row->city_id ?>" <?= set_select('city_to', $row->city_id) ?>><?= $row->city_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['city_to'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-4">
                                <div class="input-box">
                                    <label class="label-text">Date de départ</label>
                                    <div class="form-group">
                                        <span class="la la-calendar form-icon"></span>
                                        <input class="date-range form-control" value="<?= set_value('depart_date') ?>"
                                               type="date" name="depart_date">
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['depart_date'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-4" id="return_date">
                                <div class="input-box">
                                    <label class="label-text">Lieu de départ</label>
                                    <div class="form-group">
                                        <span class="la la-map-pin form-icon"></span>
                                        <input class="form-control" value="<?= set_value('start_depart') ?>"
                                               type="text" name="start_depart">
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['start_depart'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-4">
                                <div class="input-box">
                                    <label class="label-text">Heure de départ</label>
                                    <div class="form-group">
                                        <span class="la la-calendar form-icon"></span>
                                        <input class="form-control" placeholder="8:12 PM"
                                               value="<?= set_value('takeoff_time') ?>" type="text" name="takeoff_time">
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['takeoff_time'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-4">
                                <div class="input-box">
                                    <label class="label-text mb-0">Machine</label>
                                    <div class="form-group select-contain w-100">
                                        <select class="select-contain-select" name="airline_id">
                                            <option value="">--Selectionner la machine--</option>
                                            <?php foreach ($airlines as $airline): ?>
                                                <option value="<?= $airline->airline_id ?>" <?= set_select('airline_id', $airline->airline_id) ?>><?= $airline->airline_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['airline_id'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-4 -->


                            <div class="col-lg-3">
                                <div class="input-box">
                                    <label class="label-text">Nombre de places</label>
                                    <div class="form-group">
                                        <span class="la la-neuter form-icon"></span>
                                        <input class="form-control" type="text" name="place_numbers"
                                               placeholder="Entrer le nombre" value="<?= set_value('place_numbers') ?>">
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['place_numbers'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-3">
                                <div class="input-box">
                                    <label class="label-text">Price par place</label>
                                    <div class="form-group">
                                        <span class="la la-dollar form-icon"></span>
                                        <input class="form-control" type="text" name="price_by_place"
                                               placeholder="Enter price" value="<?= set_value('price_by_place') ?>">
                                    </div>
                                    <small class="text-danger ml-5"><?= $validation['price_by_place'] ?? null; ?></small>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-6">
                                <div class="col-lg-6">
                                    <div class="submit-box pt-3">
                                        <div class="btn-box ">
                                            <button type="submit" class="theme-btn">Enregistrer <i
                                                        class="la la-arrow-right ml-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col-lg-3 -->
                            </form>
                        </div><!-- end form-content -->
                    </div>
                </div><!-- end form-content -->
            </div><!-- end form-box -->
            <!-- end form-box -->
        </div><!-- end col-lg-9 -->
    </div>
</section>

<?= $this->endSection() ?>
