<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>


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

                <div class="col-lg-12">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="title">Voyages</h3>
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="la la-check mr-2"></i><?= session()->getFlashdata('success') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= base_url('bookings/listbooking') ?>" method="post">
                                    <div class="input-box row">
                                        <div class="form-group col-7">
                                            <input class="form-control" type="text" name="pinr"
                                                   placeholder="Destination" required>
                                        </div>
                                        <div class="form-group col-5">
                                            <button type="submit" class="btn btn-sm btn-primary"><i
                                                        class="la la-search"></i></button>
                                            <a href="<?= base_url('trips') ?>" class="btn btn-sm btn-success"><i
                                                        class="la la-refresh"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div><!-- end form-box -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="form-content pb-2">

            <div class="row">
                <?php foreach ($trips as $row): ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="card-item card-item-list card-item--list">
                            <div class="card-body">
                                <ul class="list-items list-items-2 pt-2 pb-3 mt-4">
                                    <li>
                                        <span>Destination :</span><?=$row->city_name ?>
                                    </li>
                                    <li>
                                        <span>Date de départ :</span><?= date('d M Y', strtotime($row->depart_date)) ?>
                                    </li>
                                    <li>
                                        <span>Lieu de départ: </span> <?= $row->start_depart ?>
                                    </li>
                                    <li>
                                        <span>Heure de départ: </span> <?= $row->take_off ?>
                                    </li>
                                </ul>

                                <div class="btn-box">
                                    <a href="#"
                                       class="theme-btn theme-btn-small theme-btn-transparent"><i
                                                class="la la-envelope mr-1"></i>Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?= $pager->links() ?>
                    </ul>
                </nav>
            </div>
            <!-- end card-item -->
        </div>
    </div><!-- end container-fluid -->
</section>



<?= $this->endSection() ?>
