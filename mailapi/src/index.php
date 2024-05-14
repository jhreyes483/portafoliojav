<?php

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once './class/logC/ErrorHandler.php';
include_once './class/logC/c_log.php';
$log = new Log( '../logs/apiMail.log');

if(isset($_POST)) $log->m_escribeLineaParams('Petici�n POST', $_POST);
if(isset($_GET['default']))  $log->m_escribeLinea('Petici�n GET', 'Default');
$log->m_cerrar();

if(isset($_GET['default'])){

   // die('aca 1');
   $_POST['asunto']      = 'Restablecer contrasena dd';
   $_POST['body']			 = 'Cordial saludo <br><br> Solicito cambio - 000001 de contrsena para el Sistema sicloud';
   $_POST['format']      = 'json';
   $_POST['mailEnvio']   = 'jhreyes483@misena.edu.co';
   $_POST['titulo']      = 'Sicloud';
   $_POST['remitente']   = 'Sicloud api';
   
   
    $remitente        = ($mailRemitente ?? 'sicloud.sistem@gmail.com');

   $host             = ($host          ?? 'smtp.gmail.com');

   $puerto           = ($puerto        ??  587 );

   $password         = ($password      ?? 'diwxdiplirhzlnoy');
   $protocolo        = ( $_POST['protocolo'] ?? 'tls');
      echo '<pre>';
echo print_r($mail->SMTPDebug  = 0);
echo '<pre>';

   $mail->SMTPDebug  = 0;
    die('aca');
   $mail->Host       = $host;
   $mail->Port       = $puerto;
   $mail->SMTPSecure = $protocolo;
   $mail->SMTPAuth   = true;
           
   $mail->Username   = $remitente;
           
   $mail->Password   = $password;

   $mail->setFrom(   $remitente, $titulo);
   $mail->addAddress($mailEnvio , $asunto);
   $mail->Subject    = $remitente;
    
   $mail->Body       = $body;
   $mail->CharSet    = 'UTF-8'; // Con esto ya funcionan los acentos
   $mail->IsHTML(true);

   echo '<pre>';
echo print_r($_POST);
echo '<pre>';
   
   echo $mail->send();
   die('aca');
}
   
//if(!isset($_POST['envia'])){
//   $r = ['status'=>'error','msg'=> 'esperando datos'];
//}
//$_POST['enviar'] =1;
// $_POST['mailRemitente'] $_POST['puerto']
// valida errores
//$ms = 'No envio mensaje';
// Configuracion adicional 
/* valores pre definidos
$_POST['mailRemitente'] = correo del que va salir el mensaje "debe estar configurado"
$_POST['host']          = cada servidor de correo tiene un host diferente 
$_POST['puerto']        = puerto
$_POST['password']      = contrase�a de  mailRemitemnte
*/
/*
echo '<pre>';
echo print_r($_POST);
echo '<pre>';
*/

if(isset($_POST['enviar']) && !isset($_GET['default'])){

   if((!isset($_POST['asunto']))    || $_POST['asunto']    == ''){ $status  ='error'; $msg = 'No envio mensaje: Campo asunto vacio';         }       
   if((!isset($_POST['body']))      || $_POST['body']      == ''){ $status = 'error'; $msg = 'No envio mensaje: Campo del mensaje vacio';    }  
   if((!isset($_POST['mailEnvio'])) || $_POST['mailEnvio'] == ''){ $status = 'error'; $msg = 'No envio mensaje: Campo Correo a enviar vacio';} 
   if((!isset($_POST['titulo']))    || $_POST['titulo']    == ''){ $status = 'error'; $msg = 'No envio mensaje: Campo titulo vacio';         }            
   if((!isset($_POST['remitente'])) || $_POST['remitente'] == ''){ $status = 'error'; $msg = 'No envio mensaje: Campo del Remitente vacio';  }  
     // if((!isset($_POST['format']))    || $_POST['format']    == '') echo die('Error, no indico formato de respuesta');
   require '../_model/class.conexion.php';
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
   extract($_POST);
   $remitente        = ($mailRemitente ?? 'sicloud.sistem@gmail.com');
   $host             = ($host          ?? 'smtp.gmail.com');
   $puerto           = ($puerto        ??  587 );
   $password         = ($password      ?? 'diwxdiplirhzlnoy');
   $protocolo        = ( $_POST['protocolo'] ?? 'tls');
   $mail->SMTPDebug  = 0;
   $mail->Host       = $host;
   $mail->Port       = $puerto;
   $mail->SMTPSecure = $protocolo;
   $mail->SMTPAuth   = true;
   $mail->Username   = $remitente;
   $mail->Password   = $password;
   $mail->setFrom(   $remitente, $titulo);
   $mail->addAddress($mailEnvio , $asunto);
   $mail->Subject    = $remitente;
   $mail->Body       = $body;
   $mail->CharSet    = 'UTF-8'; // Con esto ya funcionan los acentos
   $mail->IsHTML(true);


   if(!isset($status)){
      if (!$mail->send()){
        $msg      = 'No envio mensaje:'.$mail->ErrorInfo;
        $status   = 'error';
      }else{
         $msg     = 'Correo enviado';
         $status  = 'ok';
      }
   }
   $db         =  new c_MySQLi;
   $sql        = 'INSERT INTO config (id_config, mailRemitente, host, puerto, pasword) 
                  VALUES (NULL, "'.$remitente.'", "'.$host.'", "'.$puerto.'", "'.$password .'")';
   $b          = $db->m_ejecuta($sql);
   $p[0] = 'id_config';
   $p[1] = 'config';
   $id_config  = $db->m_ultimo_id($p); 
   $sql        = 'INSERT INTO log_correos (id, asunto, body, format, mailEnvio, titulo, remitente, estado, error, id_config, fecha) 
                  VALUES (NULL, "'.$asunto.'", "'. ($body).'", "'.$format.'", "'.$mailEnvio.'", "'.$titulo.'", "'.$remitente.'", "'.$status.'","'.( $status == 'error' ? $msg : "").'", "'.$id_config.'","'.date('Y-m-d H:i:s').'")';
   $b          = $db->m_ejecuta($sql);
}else{
   $status = 'error'; $smg = 'Error esperando datos de envio';
}

if(!isset($resultTipe)) $resultTipe = '1';  
switch($resultTipe){
   case '1':
      $r = ['status'=>$status, 'msg'=>($msg??'Esperando datos de envio' )  ] ;
      break;

   case '2':
      $r = ['response_status'=>$status, 'response_msg'=>$msg];
      break;
}

if(!isset($format)) $format ='json';
if(isset($format)){

   switch ($format) {
      case 'json':
         header("Content-Type: application/json; carset=UTF-8");
         echo json_encode($r);
         die();
         break;
      case 'html':
         $color = ($r['status'] == 'ok') ? 'success' :'danger';
         echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">'.
         '<br><br>
         <div class="my-2 mx-auto col-md-6 alert alert-'.$color.' alert-dismissible fade show" role="alert">
            '.$r['msg'].'
        </div>';
         break;
         $url =  $_SERVER['PHP_SELF'];
         $url = 'http://localhost/mailapi/correo.php';
      case 'alert':
         echo '<script> location.href="' . $url . '";</script>';
         break;

      case 'string':
         echo '<pre>'.print_r($r).'</pre>';
         break;

   }
}

?>
