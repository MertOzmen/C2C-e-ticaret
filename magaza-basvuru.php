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



            

                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Mağaza Başvurusu</h2>
                        <div class="personal-info inner-page-padding">
                        <form action="admin/setting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">

                            <?php if (@$kullanicicek['kullanici_magaza'] == 0) { ?>

                                <P>Başvuru işleminizi tamamlamak için tüm bilgilerinizin eksiksiz ve dogru olarak girilmesine özen gösteriniz. Eksik ya da hatalı bilgi olduğunda başvurunuz iptal edilecektir. </P>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mail</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" disabled="" id="first-name" value="<?php echo $kullanicicek['kullanici_mail'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Banka Adı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name='kullanici_banka' value="<?php echo $kullanicicek['kullanici_banka'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">IBAN Numaranız</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name='kullanici_iban' value="<?php echo $kullanicicek['kullanici_iban'] ?>" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name='kullanici_ad' value="<?php echo $kullanicicek['kullanici_ad'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Soyad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="last-name" name='kullanici_soyad' value="<?php echo $kullanicicek['kullanici_soyad'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Telefon GSM</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="company-name" name='kullanici_gsm' value="<?php echo $kullanicicek['kullanici_gsm'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Bireysel/Kurumsal</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kullanici_tip" id="kullanici_tip" class='select2'>
                                                <option <?php

                                                        if ($kullanicicek['kullanici_tip'] == "PERSONAL") {
                                                            echo "selected";
                                                        }

                                                        ?> value="PERSONAL">Bireysel </option>

                                                <option <?php

                                                        if ($kullanicicek['kullanici_tip'] == "PRIVATE_COMPANY") {
                                                            echo "selected";
                                                        }

                                                        ?> value="PRIVATE_COMPANY">Kurumsal </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="tc">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">T.C</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" type="text">
                                        </div>
                                    </div>
                                </div>


                                <div id="kurumsal">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Ünvan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kullanici_unvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Vergi Daire</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kullanici_vdaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Vergi No</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kullanici_vno" value="<?php echo $kullanicicek['kullanici_vno'] ?>" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Açık Adres</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" required="" name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İl</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" required="" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İlçe</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" required="" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Onay</label>
                                    <div class="checkbox">
                                        <div class="col-sm-9">
                                            <label><input type="checkbox" required="" value="">Kullanım şartlarını kabul ediyorum.</label>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">

                                    <div align="right" class="col-sm-12">

                                        <button class="update-btn" name='musterimagazabasvuru' id="login-update">Başvuruyu Tamamla</button>
                                    </div>
                                </div>
                                </form>

                            <?php } else if (@$kullanicicek['kullanici_magaza'] == 1)  { ?>

                                <div class="alert alert-success">
                                    <strong>Bilgi!</strong> Başvurunuz Onay Aşamasında......

                                    <p>Başvurularınız genellikle 24 saat içinde incelen,r ve sonuçlandırılır.</p>
                                </div>

                           

                             <?php } else if (@$kullanicicek['kullanici_magaza'] == 2)  { ?>

                                <div class="alert alert-success">
                                    <strong>Bilgi!</strong> Başvurunuz Onaylandı

                                    <p>Mağaza yönetim menüsünden Mağazanınız yönetebilirsiniz.</p>
                                </div>

                            <?php }  ?>
                        </div>
                    </div>

                </div>

            </form>




        </div>
    </div>
</div>
</div>



<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {

        $("#kullanici_tip").change(function() {

            var tip = $("#kullanici_tip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#tc").show();
            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#tc").hide();
            }

        }).change();

    });
</script>