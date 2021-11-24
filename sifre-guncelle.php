<?php

include 'header.php';

islemkontrol();

?>



<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>

<div class="settings-page-area bg-secondary section-space-bottom">



    <div class="container">

        <?php include 'hesap-sidebar.php' ?>

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">


            <?php
            if (@$_GET['durum'] == "hata") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> İşlem Başarısız
                </div>
            <?php } else if (@$_GET['durum'] == "ok") { ?>

                <div class="alert alert-success">
                    <strong>Bilgi!</strong> İşlem Başarılı
                </div>

            <?php } else if (@$_GET['durum'] == "eskisifrehata") { ?>

                <div class="alert alert-danger">
                    <strong>Bilgi!</strong> Eski Şifreniz Hatalı
                </div>

            <?php } else if (@$_GET['durum'] == "sifreleruyusmuyor") { ?>

                <div class="alert alert-danger">
                    <strong>Bilgi!</strong> Şifreler Uyuşmuyor
                </div>


            <?php } else if (@$_GET['durum'] == "eksiksifre") { ?>

                <div class="alert alert-danger">
                    <strong>Bilgi!</strong> Yeni Şifreniz en az 6 karakterden olumalı
                </div>
            <?php  }    ?>



            <form action="admin/setting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Şifre Güncelleme</h2>
                        <div class="personal-info inner-page-padding">



                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Şifrenizi Giriniz</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first-name" name='kullanici_eskipassword' placeholder="Eski Şifrenizi Giriniz" type="password" ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Yeni Şifrenizi Giriniz</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first-name" name='kullanici_passwordone' placeholder="Yeni Şifrenizi Giriniz" type="password" ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Yeni Şifrenizi Tekrar Giriniz</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first-name" name='kullanici_passwordtwo' placeholder="Yeni Şifrenizi Tekrar Giriniz" type="password" ?>
                                </div>
                            </div>

                            <div class="form-group">

                                <div align="right" class="col-sm-12">

                                    <button class="update-btn" name='musterisifreguncelle' id="login-update">Şifre Güncelle</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
</div>



<?php include 'footer.php'; ?>