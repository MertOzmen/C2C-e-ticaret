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
                    <strong>Bilgi!</strong> Kayıt Başarılı
                </div>
            <?php  }    ?>

            <form action="admin/setting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Adres Bilgilerimi Düzenle</h2>
                        <div class="personal-info inner-page-padding">
                           
                        <div class="form-group">
                                <label class="col-sm-3 control-label">Bireysel/Kurumsal</label>
                                <div class="col-sm-9">
                                    <div class="custom-select">
                                        <select name="kullanici_tip" id="kullanici_tip" class='select2'>
                                            <option 
                                            
                                            <?php 
                                            
                                            if($kullanicicek['kullanici_tip']=="PERSONAL"){
                                                echo "selected";
                                            }
                                            
                                            ?>                                         
                                            value="PERSONAL">Bireysel </option>

                                            <option 
                                            <?php 
                                            
                                            if($kullanicicek['kullanici_tip']=="PRIVATE_COMPANY"){
                                                echo "selected";
                                            }
                                            
                                            ?>
                                            value="PRIVATE_COMPANY">Kurumsal </option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="tc">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">T.C</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" type="text">
                                </div>
                            </div>
                            </div>


                            <div id="kurumsal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Firma Ünvan</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" name="kullanici_unvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Firma Vergi Daire</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" name="kullanici_vdaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Firma Vergi No</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" name="kullanici_vno" value="<?php echo $kullanicicek['kullanici_vno'] ?>" type="text">
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Açık Adres</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" required="" name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">İl</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" required="" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">İlçe</label>
                                <div class="col-sm-9">
                                    <input class="form-control"  id="first-name" required="" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" type="text">
                                </div>
                            </div>



                            <div class="form-group">

                                <div align="right" class="col-sm-12">

                                    <button class="update-btn" name='musteriadresguncelle' id="login-update">Bilgileri Güncelle</button>
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

<script >

$(document).ready(function(){

$("#kullanici_tip").change(function(){

var tip=$("#kullanici_tip").val();

if(tip=="PERSONAL"){

    $("#kurumsal").hide();
    $("#tc").show();
}
else if(tip=="PRIVATE_COMPANY"){

    $("#kurumsal").show();
    $("#tc").hide();
}

}).change();

});

</script>