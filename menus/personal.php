
<!-- CSS only -->

<?php
$sitiesAll[0] = ['Naruto'  => 'https://www3.animeflv.net/anime/boruto-naruto-next-generations-tv','db laikaapp'                      => 'dblaikaapp',                  'db stg dev'                     => 'dbstgdev'];
$sitiesAll[1] = ['Facebook' => 'https://www.facebook.com/'                                        ,'backoffice loc'                   => 'http://127.0.0.1:8000',       'backoffice web'                 => 'https://lkdev-backoffice.laika.com.co/gateway/phone_order_mw#'];
$sitiesAll[2] = ['Whatsapp' => 'https://web.whatsapp.com/',                                        'pm-compra Chile'                  => 'https://lk-primeramilla.laika.com.co:8002/','pm-compra Mexico' => 'https://meet.google.com/vzw-fdev-eab?authuser=0'];
$sitiesAll[3] = ['Youtobe' => 'https://www.youtube.com/',                     'jira' => 'https://laika.atlassian.net/browse/PMILLA-205'    ,'bk-office-p-milla'                                     => 'https://lk-primeramilla.laika.com.co:9002/'];
$sitiesAll[4] = ['github'  => 'https://github.com/', 'db-free' => 'https://console.clever-cloud.com/users/me/addons/addon_826ccccf-f60c-488e-8589-5229ea1cdae1', 'control' => 'http://localhost/pers/'] // password 12345678
?>

<link href="public/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="public/css/fonts1.css"       rel="stylesheet">
<script src="public/js/fontawasome-ico.js"></script>
<script src="public/js/jquery-3.5.1.min.js"></script>
<script src="public/js/reloj.js"></script>


<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto my-4">
            <div class="card card-body h4">
            Server personal Javier
            <a href="https://portafoliojav.herokuapp.com/_view/home.php">Portafolio</a>
            
            </div>
            <div id="reloj" class=""></div>
            <i class=" fas fa-laptop-code fs-2 my-2"></i> <br>
    </div>
</div>

<div class="container ">


<?php
echo abs($ddd ?? 0);

foreach ($sitiesAll as $i => $d) {
    ?>          
<div class="row col-md-11 mx-auto">
    <?php
    foreach ($d as $k => $g) {
        echo '<a class="btn btn-sm btn-dark my-2 col m-2 p-2" mx-auto href="' . $g . '"><b>' . $k . '</b></a>';
    }
    ?>
</div>
    <?php
}
?>
</div>





