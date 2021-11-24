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

            <?php  }    ?>



            <form action="admin/setting/adminislem.php" method="POST" enctype="multipart/form-data" class="form-horizontal"   id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Profil Resim Güncelle</h2>
                        <div class="personal-info inner-page-padding">



                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mevcut Resim</label>
                                <div class="col-sm-9">
                                     <img  src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Profil Resminizi Şeçiniz</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first-name" required="" name='kullanici_magazafoto'  type="file" ?>
                                </div>
                            </div>

                            <input type="hidden" name='eski_yol' value="<?php echo $kullanicicek['kullanici_magazafoto'] ?>">

                            <div class="form-group">

                                <div align="right" class="col-sm-12">

                                    <button class="update-btn" name='kullaniciresimguncelle' id="login-update"> Güncelle</button>
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