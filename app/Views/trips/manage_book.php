<?= $this->extend("layouts/website") ?>
<?= $this->section("content") ?>
<?php
//Session for Trips id
session()->set('trip_id', $trip->trip_id);
$trip_sess = session()->get('trip_id');
helper('form');
?>
    <!-- ================================
        START FAQ AREA
    ================================= -->
    <section class="faq-area">
        <div class="container">
            <div class="row padding-top-40px">
                <div class="col-lg-12">
                    <div id="description" class="page-scroll">
                        <div class="single-content-item pb-4">
                            <h3 class="title font-size-26"><?= $from->city_name ?? "" ?>
                                To <?= $trip->city_name ?? "" ?></h3>
                            <div class="d-flex align-items-center pt-2">
                                <p class="mr-2"><?= $trip->trip_categorie ?? "" ?> flight</p>
                                <p>
                                    <span class="badge badge-warning text-white font-weight-medium font-size-16"><?= $trip->nb_stop ?? "" ?>  Stop</span>
                                </p>
                            </div>
                        </div><!-- end single-content-item -->
                        <div class="section-block"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="faq-forum pl-4">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">Manage Passengers</h3>
                            </div><!-- form-title-wrap -->

                            <div class="form-content">
                                <div class="contact-form-action">
                                    <?= form_open('trips/passengersData') ?>
                                    <?php
                                    if ($session_data["adult_number"] >= 1) {
                                        for ($adult = 1; $adult <= $session_data['adult_number']; $adult++) {
                                            echo '
                                                    <label class="label-text"> Adult ' . $adult . '  </label>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="adult_firstname[]" placeholder="Adult First Name" required>
                                                        </div> 
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="adult_lastname[]" placeholder="Adult Last Name" required>
                                                        </div>   
                                                       <div class="col-sm-3">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select" name="adult_gender[]" required>
                                                                <option value="">Select gender</option>
                                                                    <option value="M">M</option>
                                                                    <option value="F">F</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select" name="adult_class[]" required>
                                                                <option value="">Confirm class</option>
                                                                    <option value="Premium">Premium</option>
                                                                    <option value="Economy">Economy</option>
                                                                    <option value="Business">Business</option>
                                                                    <option value="First class">First class</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="section-block"></div>
                                                 ';
                                        }
                                    }
                                    if ($session_data['child_number'] >= 1) {
                                        for ($child = 1; $child <= $session_data['child_number']; $child++) {
                                            echo '
                                                   <label class="label-text"> Child ' . $child . ' (2+ -12 years)   </label>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="child_firstname[]" placeholder="Child First Name" required>
                                                        </div> 
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="child_lastname[]" placeholder="Child Last Name" required>
                                                        </div>   
                                                       <div class="col-sm-3">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select" name="child_gender[]" required>
                                                                <option value="">Select gender</option>
                                                                    <option value="M">M</option>
                                                                    <option value="F">F</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select" name="child_class[]" required>
                                                                <option value="">Confirm class</option>
                                                                    <option value="Premium">Premium</option>
                                                                    <option value="Economy">Economy</option>
                                                                    <option value="Business">Business</option>
                                                                    <option value="First class">First class</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="section-block"></div>
                                                 ';
                                        }
                                    }
                                    if ($session_data['infants_number'] >= 1) {
                                        for ($infant = 1; $infant <= $session_data['infants_number']; $infant++) {
                                            echo '

                                             <label class="label-text"> Infant ' . $infant . ' (0-2 years)   </label>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="infant_firstname[]" placeholder="Infant First Name" required>
                                                        </div> 
                                                        <div class="col-sm-3">
                                                             <input class="form-control" type="text" name="infant_lastname[]" placeholder="Infant Last Name" required>
                                                        </div>   
                                                       <div class="col-sm-3">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select" name="infant_gender[]" required>
                                                                <option value="">Select gender</option>
                                                                    <option value="M">M</option>
                                                                    <option value="F">F</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="section-block"></div>
                                        ';
                                        }
                                    }
                                    ?>
                                    <div class="btn-box mt-3">
                                        <button type="submit" class="theme-btn">Submit</button>
                                        <a href="<?= base_url() ?>"
                                           onclick="return confirm('Are you sure to leave this form ?');"
                                           class="theme-btn float-right">Cancel</a>
                                    </div>
                                    </form>
                                </div><!-- end contact-form-action -->
                            </div><!-- end form-content -->
                        </div><!-- end form-box -->
                    </div><!-- end faq-forum -->
                </div><!-- end col-lg-4 -->

                <div class="col-lg-12">
                    <div class="single-content-wrap padding-top-60px">
                        <div id="description" class="page-scroll">
                            <div class="single-content-item py-4">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="single-feature-titles text-center mb-3">
                                            <h3 class="title font-size-15 font-weight-medium">Flight Take off</h3>
                                            <span class="font-size-13"><?= $trip->take_off ?></span>
                                        </div>
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="single-feature-titles text-center mb-3">
                                            <i class="la la-clock-o text-color font-size-22"></i>
                                            <span class="font-size-13 mt-n2"><?= $trip->total_time ?></span>
                                        </div>
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="single-feature-titles text-center mb-3">
                                            <h3 class="title font-size-15 font-weight-medium">Flight Landing</h3>
                                            <span class="font-size-13"><?= $trip->landing ?></span>
                                        </div>
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-12">
                                        <div class="single-feature-titles text-center border-top border-bottom py-3 mb-4">
                                            <h3 class="title font-size-15 font-weight-medium">Total flight time:<span
                                                        class="font-size-13 d-inline-block ml-1 text-gray"><?= $trip->total_time ?></span>
                                            </h3>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-plane"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Airline</h3>
                                                <span class="font-size-13"><?= ucfirst($trip->airline_name) ?></span>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Flight Type</h3>
                                                <span class="font-size-13"><?= $session_data["caoch"] ?></span>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-user-edit"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Adults</h3>
                                                <span class="font-size-13"><?= ($session_data["adult_number"] > 1) ? $session_data["adult_number"] . "/ Persons" : $session_data["adult_number"] . "/ Person" ?> </span>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-empire"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Childrens</h3>
                                                <span class="font-size-13"><?= ($session_data["child_number"] > 1) ? $session_data["child_number"] . "/ Persons" : $session_data["child_number"] . "/ Person" ?> </span>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-users"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Infants</h3>
                                                <span class="font-size-13"><?= ($session_data["infants_number"] > 1) ? $session_data["infants_number"] . "/ Persons" : $session_data["infants_number"] . "/ Person" ?> </span>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="single-tour-feature d-flex align-items-center mb-3">
                                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                <i class="la la-money-bill"></i>
                                            </div>
                                            <div class="single-feature-titles">
                                                <h3 class="title font-size-15 font-weight-medium">Price
                                                    for <?= $session_data["caoch"] ?> Class</h3>
                                                <?php if ($session_data["caoch"] === "Business"): ?>
                                                    <span class="font-size-13">$ <?= $trip->fixed_price_business_class ?> /Adult</span>
                                                <?php elseif ($session_data["caoch"] === "Premium"): ?>
                                                    <span class="font-size-13">$ <?= $trip->fixed_price_premium_class ?> /Adult</span>
                                                <?php elseif ($session_data["caoch"] === "Economy"): ?>
                                                    <span class="font-size-13">$ <?= $trip->fixed_price_economic_price ?> /Adult</span>
                                                <?php elseif ($session_data["caoch"] === "First class"): ?>
                                                    <span class="font-size-13">$ <?= $trip->fixed_price_first_class ?> /Adult</span>
                                                <?php endif; ?>
                                            </div>
                                        </div><!-- end single-tour-feature -->
                                    </div><!-- end col-lg-4 -->
                                </div><!-- end row -->
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div><!-- end description -->

                    </div><!-- end single-content-wrap -->
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end faq-area -->
    <!-- ================================
        END FAQ AREA
    ================================= -->
<?= $this->endSection() ?>