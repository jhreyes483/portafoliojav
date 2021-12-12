<?php

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">




</html>


<div class="container my-2">
   <div class="col-md-4 mx-auto">
      <div class="card card-body">
         <div class="card-title">Emisoras</div>
         <form action="" method="post">
            <select name="emisora" id="" class="form-control" onchange="submit(this)">
           
               <?php
               echo ' <option selected value="">Seleccione</option>';
               foreach (['oxigeno', 'Radio Activa', '40 principales', 'La FM', 'vibra', 'Blu radio', 'Javeriana', 'Tropicana','La mega','Olimpica','La X','Candela'] as $k => $d) {
                  echo '<option ' . (($k == $_POST['emisora']) ? ' selected ' : '') . ' value="' . $k . '">' . $d . '</option>';
               }
               ?>
            </select>
         </form>
      </div>
   </div>
</div>


<div class=" my-4 col-md-4 mx-auto card shadow">



   <?php


   if (isset($_POST) && !empty($_POST)) {
      switch ($_POST['emisora']) {
         case 0: // oxigeno
            echo '<iframe src="//envivo.oxigeno.fm/widget/directo/bogota/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 1: // Radio Activa
            echo '<iframe src="//envivo.radioacktiva.com/widget/directo/bogota/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 2: // 40 principales
            echo '<iframe src="https://play.los40.com/widget/directo/los40/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 3:
            echo '<audio autoplay controls="controls"> <source src="https://20823.live.streamtheworld.com/LA_FM_BOGAAC.aac" type="audio/ogg" /> </audio>';
            break;
         case 4:
            echo '<iframe src="https://vibra.co/wp-content/plugins/player/player-wepa-widget.php?wstation=VIBRA&wimage=vibra&stationid=57239"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 5:
            echo '<audio autoplay controls="controls"> <source src="https://playerservices.streamtheworld.com/api/livestream-redirect/BLURADIO_ADP.aac" type="audio/ogg" /> </audio>';
            break;
         case 6:
            echo '<audio autoplay controls="controls"> <source src="http://lira.servidoranonimo.org/proxy/javerian?mp=/stream" type="audio/ogg" /> </audio>';
            break;
         case 7;
            echo '<iframe src="//envivo.tropicanafm.com/widget/directo/bogota/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 8;
            echo '<audio autoplay controls="controls"> <source src="https://21933.live.streamtheworld.com/LA_MEGA_BOGAAC_SC" type="audio/ogg" /> </audio>';
            break;
         case 9;
          echo '<iframe src="https://olimpicastereo.com.co/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
         case 10;
         echo '<iframe src="https://www.laxmasmusica.com/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
           break;
         case 11:
         echo '<iframe src="https://www.candelaestereo.com/radio-en-vivo/"  width="100%" height="30%"  frameborder="0" allowfullscreen></iframe>';
            break;
            

         default:
            # code...
            break;
      }
   }



   ?>
</div>