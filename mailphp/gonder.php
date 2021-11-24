<title>Test Mail Gönderimi</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php


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
$mail->AddAddress("mert61ozmen@gmail.com"); // Mail gönderilecek adresleri ekliyoruz.
$mail->Subject  = $konu;//"Deneme Maili"; // Mailin Konusu Konu
//Mailimizin gövdesi: (HTML ile)
$mail->Body = "Bu bir test mailidir. Gövdede yer alacak metin bundan ibarettir.";

if ($mail->Send()) {
	
	echo "Mail Gönderimi Başarılı. Posta Kutusunu Kontrol Et";

}

else {

echo "Mail Gönderimi Başarısız"; echo "<br>";
echo "Hata: ".$mail->ErrorInfo;


}


?>