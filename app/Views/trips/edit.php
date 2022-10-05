<?= $this->extend("layouts/dashboard") ?>
<?= $this->section("content") ?>
<?php helper('form'); ?>
<!-- ================================
    START FORM AREA
================================= -->
<div class="dashboard-main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title"><i class="la la-gear mr-2 text-gray"></i>Listing information for your flight
                        </h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        <?= form_open('trips/edit/'.$trip->trip_id, 'class="row"') ?>

                        <div class="col-lg-6 responsive-column">
                            <div class="input-box">
                                <label class="label-text">Flight From</label>
                                <div class="form-group select-contain w-100">
                                    <select class="select-contain-select" name="city_from">
                                        <option value="<?= $city_from->city_from_id ?>" <?= set_select('city_from', $city_from->city_from_id)?>> <?= $city_from->city_name ?></option>
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
                                <label class="label-text">Flight To</label>
                                <div class="form-group select-contain w-100">
                                    <select class="select-contain-select" name="city_to">
                                        <option value="<?= $trip->city_to_id ?>" <?= set_select('city_to', $trip->city_to_id)?>> <?= $trip->city_name ?></option>
                                        <?php foreach ($cities as $row): ?>
                                            <option value="<?= $row->city_id ?>" <?= set_select('city_to', $row->city_id) ?>><?= $row->city_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <small class="text-danger ml-5"><?= $validation['city_to'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->

                        <div class="col-lg-4 responsive-column">
                            <div class="input-box">
                                <label class="label-text">Flight</label>
                                <div class="form-group select-contain w-100">
                                    <select class="select-contain-select" name="trip_category" id="trip_categorie"
                                            onchange="showElement()">
                                        <option value="<?= $trip->trip_categorie ?>"<?= set_select('trip_category', $trip->trip_categorie) ?>><?= $trip->trip_categorie ?>
                                            Flight
                                        </option>

                                        <option value="One way"<?= set_select('trip_category', "One way") ?>>One Way
                                            Flight
                                        </option>
                                        <option value="Round" <?= set_select('trip_category', "Round") ?>>Round-trip
                                            Flight
                                        </option>
                                        <option disabled
                                                value="MultiCity" <?= set_select('trip_category', "MultiCity") ?>>
                                            Multi-city Flight
                                        </option>
                                    </select>
                                </div>
                                <small class="text-danger ml-5"><?= $validation['trip_category'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-4">
                            <div class="input-box">
                                <label class="label-text">Depart Date</label>
                                <div class="form-group">
                                    <span class="la la-calendar form-icon"></span>
                                    <input class="date-range form-control" value="<?= $trip->depart_date ?? set_value('depart_date') ?>"
                                           type="date" name="depart_date">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['depart_date'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-4" id="return_date">
                            <div class="input-box">
                                <label class="label-text">Return Date</label>
                                <div class="form-group">
                                    <span class="la la-calendar form-icon"></span>
                                    <input class="date-range form-control" value="<?= $trip->return_date ?? set_value('return_date') ?>"
                                           type="date" name="return_date">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['return_date'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->

                        <div class="col-lg-4">
                            <div class="input-box">
                                <label class="label-text">Take off</label>
                                <div class="form-group">
                                    <span class="la la-calendar form-icon"></span>
                                    <input class="form-control" placeholder="3:30 AM"
                                           value="<?= $trip->take_off ?? set_value('takeoff_time') ?>" type="text" name="takeoff_time">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['takeoff_time'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-4">
                            <div class="input-box">
                                <label class="label-text">Landing</label>
                                <div class="form-group">
                                    <span class="la la-calendar form-icon"></span>
                                    <input class="form-control"  placeholder="8:30 PM" value="<?= $trip->landing ?? set_value('landing_time') ?>" type="text" name="landing_time">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['landing_time'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-4">
                            <div class="input-box">
                                <label class="label-text">Flight Stops</label>
                                <div class="form-group select-contain w-100">
                                    <select class="select-contain-select" name="flight_stops">
                                        <option value="<?= $trip->nb_stop?>" <?= set_select('flight_stops', $trip->nb_stop) ?>><?= $trip->nb_stop?> Stops</option>
                                        <option value="0" <?= set_select('flight_stops', '0') ?>>0 Stop</option>
                                        <option value="1" <?= set_select('flight_stops', '1') ?>>1 Stop</option>
                                        <option value="2" <?= set_select('flight_stops', '2') ?>>2 Stops</option>
                                        <option value="3" <?= set_select('flight_stops', '3') ?>>3 Stops</option>
                                    </select>
                                </div>
                                <small class="text-danger ml-5"><?= $validation['flight_stops'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-12">
                            <div class="form-title-wrap">
                                <h3 class="title"><i class="la la-plane mr-2 text-gray"></i>Information about your
                                    flight</h3>
                            </div><!-- form-title-wrap -->
                        </div>
                        <div class="col-lg-12">
                            <div class="input-box">
                                <label class="label-text">Total time of flight</label>
                                <div class="form-group">
                                    <span class="la la-clock form-icon"></span>
                                    <input class="form-control" type="text" name="total_time"
                                           placeholder="Total time of flight ex. 2 hours 30 min"
                                           value="<?= $trip->total_time ?? set_value('total_time') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['total_time'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-12 -->

                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price range (First Class)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="first_price" placeholder="Enter price"
                                           value="<?= $trip->fixed_price_first_class ?? set_value('first_price') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['first_price'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price range (Economic)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="economic_price"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_economic_price ?? set_value('economic_price') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['economic_price'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price range (Premium)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="premium_price"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_premium_class ?? set_value('premium_price') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['premium_price'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price range (Business)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="business_price"
                                           placeholder="Enter price" value="<?=$trip->fixed_price_business_class ?? set_value('business_price') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['business_price'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-4">
                            <div class="input-box">
                                <label class="label-text mb-0">Airline</label>
                                <div class="form-group select-contain w-100">
                                    <select class="select-contain-select" name="airline_id">
                                        <option value="<?= $trip->airline_id?>" <?= set_select('airline_id', $trip->airline_id )?>><?= $trip->airline_name?></option>
                                        <?php foreach ($airlines as $airline): ?>
                                            <option value="<?= $airline->airline_id ?>" <?= set_select('airline_id', $airline->airline_id) ?>><?= $airline->airline_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <small class="text-danger ml-5"><?= $validation['airline_id'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-4 -->
                        <div class="col-lg-8">
                            <div class="input-box">
                                <label class="label-text mb-0">Flight Conditions</label>
                                <div class="form-group select-contain w-100">
                                    <textarea class="form-control " name="condition_fly"
                                              rows="1"><?= $trip->conditions ?? set_value('condition_fly') ?></textarea>
                                </div>
                                <small class="text-danger ml-5"><?= $validation['condition_fly'] ?? null; ?></small>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-0">
                            <div class="form-title-wrap">
                                <h3 class="title"><i class="la la-plane mr-2 text-gray"></i>Price range
                                    flight Children and Infants</h3>
                            </div><!-- form-title-wrap -->
                        </div>
                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price Child (Premium)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="fixed_price_child_premium"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_child_premium ??  set_value('fixed_price_child_premium') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['fixed_price_child_premium'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price Child (Economic)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="fixed_price_child_economic"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_child_economic ?? set_value('fixed_price_child_economic') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['fixed_price_child_economic'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price Child (Business)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="fixed_price_child_business"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_child_business ?? set_value('fixed_price_child_business') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['fixed_price_child_business'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Price Child (First)</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="fixed_price_child_first"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_child_first ?? set_value('fixed_price_child_first') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['fixed_price_child_first'] ?? null; ?></small>
                            </div>
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-6">
                            <div class="input-box">
                                <label class="label-text">Price Infant</label>
                                <div class="form-group">
                                    <span class="la la-dollar form-icon"></span>
                                    <input class="form-control" type="text" name="fixed_price_infant"
                                           placeholder="Enter price" value="<?= $trip->fixed_price_infant ?? set_value('fixed_price_infant') ?>">
                                </div>
                                <small class="text-danger ml-5"><?= $validation['fixed_price_infant'] ?? null; ?></small>
                            </div>
                            <div class="col-lg-6">
                                <div class="submit-box pt-3">
                                    <div class="btn-box ">
                                        <button type="submit" class="theme-btn">Submit Listing <i class="la la-arrow-right ml-1"></i></button>
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
</div><!-- end row -->
</div><!-- end container -->
</div>
<!-- ================================
    END FORM AREA
================================= -->
<?= $this->endSection() ?>
