<?php

$_POST['enviar'] = 1;
if (isset($_POST['enviar'])) {
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
    $mail->SMTPDebug = 1;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "sicloud.sistem@gmail.com";
    $mail->Password = "diwxdiplirhzlnoy";
    $mail->setFrom('sicloud.sistem@gmail.com', 'NSicloud');
    $mail->addAddress('jhreyes483@misena.edu.co', 'Pruba de correo');
    $mail->Subject = 'Sicloud imail local';
    $mail->Body = "Hola este es el correo de prueba 3";
    $mail->CharSet = 'UTF-8';
// Con esto ya funcionan los acentos
    $mail->IsHTML(true);
    if (!$mail->send()) {
        echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
    } else {
        echo "E-Mail enviado";
    }
}
