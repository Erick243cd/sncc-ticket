<?= $this->extend("layouts/website")?>
<?= $this->section("content")?>
<?php
    helper('form');
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
                                <h2 class="sec__title text-white">S'inscrire</h2>
                            </div>
                        </div><!-- end breadcrumb-content -->
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-right">
                            <ul class="list-items">
                                <li><a href="<?= base_url()?>">Accueil</a></li>
                                <li>Programmes</li>
                                <li>S'inscrire</li>
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

    <section class="contact-area padding-top-100px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">S'inscrire</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content ">
                            <div class="contact-form-action">
                                <?= form_open('register')?>
                                <input type="hidden" name="trip_id" value="<?= $trip_id ?? "" ?>">
                                     <div class="row">
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Prénom</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="first_name" placeholder="First name" value="<?= set_value('first_name')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['first_name'] ?? null?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Nom</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="last_name" placeholder="Last name" value="<?= set_value('last_name')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['last_name'] ?? null?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Adresse mail</label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="email" name="email_adress" placeholder="Email address" value="<?= set_value('email_adress')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['email_adress'] ?? null?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Numéro téléphone</label>
                                            <div class="form-group">
                                                <span class="la la-phone form-icon"></span>
                                                <input class="form-control" type="text" name="phone_number" placeholder="Phone Number" value="<?= set_value('phone_number')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['phone_number'] ?? null?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Mot de passe</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="password" name="password" value="<?= set_value('password')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['password'] ?? null?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Confirmer mot de passe</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="password" name="confirm_password" value="<?= set_value('confirm_password')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['confirm_password'] ?? ""?></small>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-8">
                                        <div class="btn-box">
                                            <button class="theme-btn" type="submit">Soumettre</button>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                     <div class="col-md-3 mt-2">
                                         <a class="text-primary mt-5 font-italic" href="<?= base_url()?>/login"><span class="la la-user form-icon"></span>Se connecter</a>
                                     </div>
                                </div>

                                </form>
                            </div><!-- end contact-form-action -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end contact-area -->

<?= $this->endSection()?>