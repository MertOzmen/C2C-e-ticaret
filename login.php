<?php include 'header.php';
error_reporting(0);  ?>


<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Üye Giriş İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">

            <?php 

            if ($_GET['durum']=="hata") {?>

            <div class="alert alert-danger">
                <strong>Hata!</strong> Hatalı Giriş
            </div>                   
            
            <?php } else if ($_GET['durum']=="exit") {?>

            <div class="alert alert-success">
                <strong>Bilgi!</strong> Başarıyla Çıkış Yapıldı
            </div>                   
                       
            
            <?php } else if ($_GET['durum']=="captchahata") {?>

            <div class="alert alert-danger">
                <strong>Hata!</strong> Güvenlik Kodu Hatalı
            </div>                   
            
            <?php } else if ($_GET['durum']=="mailno") {?>

            <div class="alert alert-danger">
                <strong>Hata!</strong> Mail sunucumuzda problem var lütfen daha sonra tekrar deneyiniz...
            </div>                   
            
            <?php } else if ($_GET['userstatus']=="no") {?>

            <div class="alert alert-danger">
                <strong>Hata!</strong> Böyle bir mail sisteme kayıtlı değil...
            </div>                   

            <?php } else if ($_GET['durum']=="basarili") {?>

            <div class="alert alert-success">
                <strong>Başarılı!</strong> Yeni şifreniz mail kutunuza başarıyla gönderilmiştir...
            </div>                   

            <?php }
            ?>




            <form action="admin/setting/kullanici.php" method="POST" id="personal-info-form">



                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="first-name">Mail Adresiniz *</label>
                            <input type="text" id="first-name" required="" placeholder="Mail Adresinizi Giriniz.." name="kullanici_mail" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifreniz Giriniz</label>
                            <input type="password" id="last-name" required="" placeholder="Şifrenizi Tekrar Giriniz..." name="kullanici_password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="first-name">Güvenlik Kodu *</label>

                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                            <a class="btn btn-danger btn-xs" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Değiştir ]</a>


                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="last-name">Güvenlik Kodunu Giriniz *</label>
                            <input type="text" id="last-name" required="" placeholder="Güvenlik Kodunu Giriniz" name="captcha_code" class="form-control">
                        </div>
                    </div>
                </div>





                <div class="row">


                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
                    <div class="pLace-order">
                        <button class="update-btn disabled" type="submit" name="musterigiris" >Gönder</button>
                        <button  class="update-btn disabled" data-toggle="modal" data-target="#sifremiunuttum" type="submit" name="musterigiris" >Şifremi Unuttum</button>

                    </div>
                </div>
            </div> 
        </form>                      
    </div> 
</div>
</div>

<!-- Modal Başlangıç -->


<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>
     
  </div>
  <div class="modal-body">
    <form action="mailphp/sifremi-unuttum.php" method="POST">
        <div class="form-group">
         <p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
     </div>
     <div class="form-group">
        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
    </div>

    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
    <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Bitiş -->

<?php include 'footer.php' ?>