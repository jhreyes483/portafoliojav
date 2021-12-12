<!DOCTYPE html>
<html>

<head>
   <meta HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
   <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <title><?= $this->titulo ?></title>
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-RE4TJL44PF"></script>
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
         dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'G-RE4TJL44PF');
   </script>
   <?php

   if (isset($_layoutParams['css']) && count($_layoutParams['css'])) {
      foreach ($_layoutParams['css'] as $css) {
         echo "\t" . '<link href="' . $_layoutParams['ruta_css'] . $css . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
      }
   }


   if (isset($_layoutParams['js']) && count($_layoutParams['js'])) {
      foreach ($_layoutParams['js'] as $js) {
         echo "\t" . '<script src="' . $_layoutParams['ruta_js'] . $js . '"></script>' . PHP_EOL;
      }
   }




   ?>
</head>