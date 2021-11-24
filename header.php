<?php

ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');

error_reporting(0);
require_once 'admin/setting/baglan.php';
require_once 'admin/production/fonksiyon.php';

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");
}

$ayarsor = $db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);



if (isset($_SESSION['userkullanici_mail'])) {


    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array(
        'mail' => $_SESSION['userkullanici_mail']
    ));
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    //Kullanıcı ID Session Atama
    if (!isset($_SESSION['userkullanici_id'])) {

        $_SESSION['userkullanici_id'] = $kullanicicek['kullanici_id'];
    }
}

$kullanici_sonzaman = @$_SESSION['userkullanici_sonzaman'];
$suan = time();

$fark = ($suan - $kullanici_sonzaman);

if ($fark > 600) {

    $zamanguncelle = $db->prepare("UPDATE kullanici SET

        kullanici_sonzaman=:kullanici_sonzaman
        
        WHERE kullanici_id={$_SESSION['userkullanici_id']}");


    $update = $zamanguncelle->execute(array(

        'kullanici_sonzaman' => date("Y-m-d H:i:s")

    ));

    $kullanici_sonzaman = @$_SESSION['userkullanici_sonzaman'];
}


?>

<!doctype html>
<html class="no-js" lang="">

<head>

    <title>

        <?php

        if (empty($title)) {


            echo $ayarcek['ayar_title'];
        } else {

            echo $title;
        }

        ?>

    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
    <meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css\normalize.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css\main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css\animate.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css\select2.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css\font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css\meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css\jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css\reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css\hover-min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Modernizr Js -->
    <script src="js\modernizr-2.8.3.min.js"></script>

    <!-- CK EDITOR -->
    <script src="admin/production/ckeditor/ckeditor.js"></script>


</head>

<body>

    <?php
    if ($ayarcek['ayar_bakim'] == 1) {

        exit("Şuan Bakımdayız...");
    }

    ?>

    <div id="preloader"></div>

    <div id="wrapper">

        <header>
            <div id="header2" class="header2-area right-nav-mobile">
                <div class="header-top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                <div class="logo-area">
                                    <a href="index.php"><img class="img-responsive" src="<?php echo $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                                <ul class="profile-notification">

                                    <?php if (isset($_SESSION['userkullanici_mail'])) {  ?>

                                        <li>
                                            <div class="notify-notification">
                                                <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i><span>

                                                        <?php
                                                        if ($kullanicicek['kullanici_magaza'] == 2) {

                                                            $siparissay = $db->prepare("SELECT COUNT(siparisdetay_onay) as say FROM siparis_detay where siparisdetay_onay=:id and kullanici_idsatici=:kullanici_id");
                                                            $siparissay->execute(array(
                                                                'id' => 0,
                                                                'kullanici_id' => $_SESSION['userkullanici_id']
                                                            ));
                                                        } else {
                                                            $siparissay = $db->prepare("SELECT COUNT(siparisdetay_onay) as say FROM siparis_detay where siparisdetay_onay=:id and kullanici_id=:kullanici_id");
                                                            $siparissay->execute(array(
                                                                'id' => 1,
                                                                'kullanici_id' => $_SESSION['userkullanici_id']
                                                            ));
                                                        }

                                                        $saycek = $siparissay->fetch(PDO::FETCH_ASSOC);

                                                        echo $saycek['say'];
                                                        ?>
                                                    </span></a>
                                                <ul>

                                                    <?php
                                                    if ($kullanicicek['kullanici_magaza'] == 2) {
                                                        $siparissor = $db->prepare("SELECT siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis
                                                    INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
                                                    INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
                                                    INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id where siparis.kullanici_idsatici=:id
                                                    and siparis_detay.siparisdetay_onay=:onay  order by siparis_zaman DESC
                                                    limit 5");

                                                        $siparissor->execute(array(
                                                            'id' => $_SESSION['userkullanici_id'],
                                                            'onay' => 0
                                                        ));

                                                        if ($siparissor->rowCount() == 0) { ?>
                                                            <li>
                                                                <div class="notify-message-info">
                                                                    <div style="color:black !important" class="notify-notification-subject">Hiç Siparişiniz Yok</div>
    
                                                                </div>
                                                            </li>
    
                                                        <?php }
                                                        
                                                    } else {

                                                        $siparissor = $db->prepare("SELECT siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis
                                                    INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
                                                    INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
                                                    INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id where siparis.kullanici_id=:id
                                                    and siparis_detay.siparisdetay_onay=:onays  order by siparis_zaman DESC
                                                    limit 5");

                                                        $siparissor->execute(array(
                                                            'id' => $_SESSION['userkullanici_id'],
                                                            'onays' => 1
                                                        ));

                                                        if ($siparissor->rowCount() == 0) { ?>
                                                            <li>
                                                                <div class="notify-message-info">
                                                                    <div style="color:black !important" class="notify-notification-subject">Hiç Onay Bekleyen Ürününüz yok</div>
    
                                                                </div>
                                                            </li>
    
                                                        <?php }
                                                    }

                                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>

                                                        <li>
                                                            <div class="notify-notification-img">
                                                                <img class="img-responsive" src="<?php echo $sipariscek['kullanici_magazafoto']; ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-notification-info">
                                                                <div class="notify-notification-subject"><?php echo $sipariscek['siparis_id'] ?></div>
                                                                <div class="notify-notification-date"><?php echo $sipariscek['kullanici_ad'] . " " . $sipariscek['kullanici_soyad'] ?></div>
                                                                <div class="notify-notification-date"><?php echo $sipariscek['siparis_zaman'] ?></div>
                                                            </div>
                                                            <div class="notify-notification-sign">
                                                                <?php if ($kullanicicek['kullanici_magaza'] == 2) { ?>
                                                                    <a href="yeni-siparisler?siparisdetay_id=<?php echo $sipariscek['siparisdetay_id'] ?>&kullanici_id=<?php echo $sipariscek['kullanici_id'] ?>">
                                                                        <i class="fa fa-bell-o" aria-hidden="true"></i></a>

                                                                <?php } else { ?>

                                                                    <a href="siparis-detay?siparis_id=<?php echo $sipariscek['siparis_id'] ?>&kullanici_id=<?php echo $sipariscek['kullanici_id'] ?>">
                                                                        <i class="fa fa-bell-o" aria-hidden="true"></i></a>

                                                                <?php  } ?>

                                                            </div>
                                                        </li>

                                                    <?php  } ?>

                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="notify-message">
                                                <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>

                                                        <?php

                                                        $mesajsay = $db->prepare("SELECT COUNT(mesaj_okunma) as say FROM mesaj where mesaj_okunma=:id and kullanici_gel=:kullanici_id");
                                                        $mesajsay->execute(array(
                                                            'id' => 0,
                                                            'kullanici_id' => $_SESSION['userkullanici_id']
                                                        ));

                                                        $saycek = $mesajsay->fetch(PDO::FETCH_ASSOC);

                                                        echo $saycek['say'];

                                                        ?>

                                                    </span></a>
                                                <ul>

                                                    <?php

                                                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj 
                                                INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id where mesaj.kullanici_gel=:id and mesaj.mesaj_okunma=:okunma
                                                 order by mesaj_okunma,mesaj_zaman DESC limit 5");
                                                    $mesajsor->execute(array(

                                                        'id' => $_SESSION['userkullanici_id'],
                                                        'okunma' => 0

                                                    ));

                                                    if ($mesajsor->rowCount() == 0) { ?>
                                                        <li>
                                                            <div class="notify-message-info">
                                                                <div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>

                                                            </div>
                                                        </li>

                                                    <?php }

                                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                                        <li>
                                                            <div class="notify-message-img">
                                                                <img class="img-responsive" src="<?php echo $mesajcek['kullanici_magazafoto']; ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-message-info">
                                                                <div class="notify-message-sender"><?php echo $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></div>
                                                                <div class="notify-message-subject">Mesaj Detayı</div>
                                                                <div class="notify-message-date"><?php echo $mesajcek['mesaj_zaman']; ?></div>
                                                            </div>
                                                            <div class="notify-message-sign">
                                                                <a href="mesaj-detay?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&kullanici_gon=<?php echo $mesajcek['kullanici_gon'] ?>">
                                                                    <i style="color:orange !important" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </li>

                                                    <?php } ?>


                                                </ul>
                                            </div>
                                        </li>


                                    <?php } ?>

                                    <?php if (isset($_SESSION['userkullanici_mail'])) {  ?>



                                        <li>
                                            <div class="user-account-info">
                                                <div class="user-account-info-controler">
                                                    <div class="user-account-img">
                                                        <img style="border-radius: 30px;" width="32" height="32" class="img-responsive" src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="Profil Resmi">
                                                    </div>
                                                    <div class="user-account-title">
                                                        <div class="user-account-name"><?php echo $kullanicicek['kullanici_ad'] . " " . substr($kullanicicek['kullanici_soyad'], 0, 1) ?>.</div>
                                                        <div class="user-account-balance">

                                                            <?php
                                                            $siparissor = $db->prepare("SELECT SUM(urun_fiyat) as toplam FROM siparis_detay where kullanici_idsatici=:kullanici_id ");

                                                            $siparissor->execute(array(
                                                                'kullanici_id' => $_SESSION['userkullanici_id']
                                                            ));

                                                            $sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC);

                                                            if (isset($sipariscek['toplam'])) {
                                                                echo $sipariscek['toplam'] . " TL";
                                                            } else {

                                                                echo "0.00 TL";
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="user-account-dropdown">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li><a href="hesabim">Hesap Bilgilerim</a></li>

                                                </ul>
                                            </div>
                                        </li>

                                        <li><a class="apply-now-btn" href="logout.php" id="logout-button">Çıkış</a></li>

                                    <?php } else { ?>

                                        <li><a class="apply-now-btn" href="login.php" id="logout-button">Giriş</a></li>
                                        <li><a class="apply-now-btn" href="register.php" id="logout-button">Kayıt Ol</a></li>

                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primaryText" id="sticker">
                    <div class="container">
                        <nav id="desktop-nav">
                            <ul>
                                <li class="active"><a href="index.php">Anasayfa</a></li>
                                <li><a href="kategoriler">Kategoriler</a></li>

                                <?php

                                $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_onecikar=:onecikar order by kategori_sira ASC");
                                $kategorisor->execute(array(
                                    'onecikar' => 1
                                ));

                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>


                                    <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>

                                <?php } ?>

                                <li><a href="hakkimizda">Hakkımızda</a></li>


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Mobil Menu alanı başlangıç -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>

                                        <li class="active"><a href="index.php">Anasayfa</a></li>
                                        <li><a href="login">Üye Giriş</a></li>
                                        <li><a href="register">Üye Kayıt</a></li>
                                        <li><a href="kategoriler">Kategoriler</a></li>

                                        <?php

                                        $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_onecikar=:onecikar order by kategori_sira ASC");
                                        $kategorisor->execute(array(
                                            'onecikar' => 1
                                        ));

                                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>


                                            <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>

                                        <?php } ?>

                                        <li><a href="hakkimizda">Hakkımızda</a></li>



                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobil Menu alanı sob -->
        </header>