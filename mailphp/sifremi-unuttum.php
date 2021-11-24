<?php
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');

require_once '../admin/setting/baglan.php';
require_once '../admin/production/fonksiyon.php';

if (isset($_POST['sifremiunuttum'])) {

	$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
	$kullanicisor->execute(array(
		'mail' => $_POST['kullanici_mail']
	));
	$say = $kullanicisor->rowCount();

	$kullanici_mail = $_POST['kullanici_mail'];


	if ($say == 0) {

		Header("Location:../login.php?userstatus=no");
		exit;
	} else {

		$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

		$uretilensifre = uniqid();
		$sifrekaydet = md5($uretilensifre);

		//Veritabanı kaydını yap

		$sifreguncelle = $db->prepare("UPDATE kullanici SET


			kullanici_password=:kullanici_password

			WHERE kullanici_mail='$kullanici_mail'");


		$update = $sifreguncelle->execute(array(


			'kullanici_password' => $sifrekaydet 	//Varitabanı kaydı bitir

		));
	
		//Mail Gönderim Başlat

	
		$konu = "Test Mail PHP Mailer Kontrol";
		$yenisifre = "Yeni Şifreniz : " . $uretilensifre;
		require("class.phpmailer.php"); // PHPMailer dosyamizi çagiriyoruz
		require("class.smtp.php"); // PHPMailer dosyamizi çagiriyoruz

		$mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
		$mail->IsSMTP(true);  // Mailimizin SMTP ile gönderilecegini belirtiyoruz
		$mail->Mailer = "smtp";
		$mail->SMTPDebug  = 1;  
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = "mertozmentezmail@gmail.com";
		$mail->Password   = "Mert90!.";
		$mail->IsHTML(true);
		$mail->setFrom("mertozmentezmail@gmail.com","mert ozmen");
		$mail->AddAddress($_POST['kullanici_mail']); // Mail gönderilecek adresleri ekliyoruz.
		$mail->Subject  = $konu;//"Deneme Maili"; // Mailin Konusu Konu
		$mail->Body = $yenisifre;
		//$mail->AltBody = $text_body;


		if ($mail->Send()) {

			Header("Location:../login.php?durum=basarili");
			exit;
		} else {
			
			Header("Location:../login.php?durum=mailno");
			exit;

			
		}
	}
}
