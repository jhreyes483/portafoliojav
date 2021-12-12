<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "eventos.banquetes.dcache@gmail.com";
$mail->Password = "@1030607384";
$mail->setFrom('eventos.banquetes.dcache@gmail.com', 'NSicloud');
$mail->addAddress('jhreyes483@misena.edu.co', 'Pruba de correo');
$mail->Subject = 'Sicloud imail';
$mail->Body = "Hola este es el correo de prueba";
$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
$mail->IsHTML(true);

if (!$mail->send())
{
	echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
else
{
	echo "E-Mail enviado";
}
?>