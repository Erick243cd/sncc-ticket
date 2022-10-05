<?= $this->extend("layouts/dashboard")?>
<?= $this->section("content")?>
<?php helper('form');?>
    <!-- ================================
        START FORM AREA
    ================================= -->
    <div class="dashboard-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title"><i class="la la-city mr-2 text-gray"></i>Ticket Confirmation</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content contact-form-action">
                            <?= form_open('bookings/confirmTicket/'.$booking->booking_id)?>
                            <div class="row">
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Booking Ref</label>
                                        <div class="form-group">
                                            <span class="la la-air-freshener form-icon"></span>
                                            <input class="form-control" type="text" name="rsv_number" placeholder="Booking ref" required>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Ticket number</label>
                                        <div class="form-group">
                                            <span class="la la-air-freshener form-icon"></span>
                                            <input class="form-control" type="text" name="ticket_number" placeholder="Ticket Number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Passenger First Name</label>
                                        <div class="form-group">
                                            <span class="la la-air-freshener form-icon"></span>
                                            <input class="form-control" type="text" name="psg_firstname" placeholder="Passenger First Name" value="<?= $booking->first_name ?>">
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Passenger Last Name</label>
                                        <div class="form-group">
                                            <span class="la la-air-freshener form-icon"></span>
                                            <input class="form-control" type="text" name="psg_lastname" placeholder="Passenger First Name" value="<?= $booking->last_name ?>">
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-md-6">
                                    <div class="submit-box">
                                        <div class="btn-box pt-3">
                                            <button type="submit" class="theme-btn">Submit <i class="la la-arrow-right ml-1" onclick="$('#sending_process').fadeIn(1500)"></i></button>
                                        </div>
                                    </div><!-- end submit-box -->
                                </div>
                                <div class="alert alert-primary alert-dismissible fade show mt-3" id="sending_process" role="alert" style="display: none">
                                    <i class="la la-check mr-2"></i>Sending mail to traveller, Please wait...
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div>
            </div>

            <div class="border-top mt-5"></div>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="copy-right padding-top-30px">
                        <p class="copy__desc">
                            &copy; Copyright Trizen 2020. Made with
                            <span class="la la-heart"></span> by <a href="#">TechyDevs</a>
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
        </div>
    </div>
<?= $this->endSection()?>



<?php
