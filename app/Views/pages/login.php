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
                                <h2 class="sec__title text-white">Connexion</h2>
                            </div>
                        </div><!-- end breadcrumb-content -->
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-right">
                            <ul class="list-items">
                                <li><a href="<?= base_url()?>">Accueil</a></li>
                                <li>Programmes</li>
                                <li>Connexion</li>
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
                <div class="col-lg-7 mx-auto">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Connexion</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content ">
                            <div class="contact-form-action">
                                <?= form_open('login')?>
                                <input type="hidden" name="trip_id" value="<?= $trip_id ?? "" ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-box">
                                            <label class="label-text">Adresse mail</label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="email" name="email_adress" placeholder="Enter email address" value="<?= set_value('email_adress')?>">
                                            </div>
                                            <small class="text-danger"><?= $validation['email_adress'] ?? null?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-box">
                                            <label class="label-text">Mot de passe</label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="password" name="password" placeholder="Enter password">
                                            </div>
                                            <small class="text-danger"><?= $validation['password'] ?? null?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="btn-box">
                                            <button type="submit" class="theme-btn">Soumettre</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <a class="text-primary mt-5 font-italic" href="<?= base_url()?>/register">Creer votre compte</a>
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