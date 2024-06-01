<?php

include_once '../public/body/header.php';

$lat =  $_REQUEST['lat'] ?? false;
$lng =  $_REQUEST['lng'] ?? false;
$location = $_REQUEST['location'] ?? '';


if (!isset($lat, $lng)  || !abs($lat) || !abs($lng)) {
    die('No hay hubicacion');
}
// geolocalizar
// https://www.cual-es-mi-ip.net/geolocalizar-ip-mapa/186.155.33.6
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<body id="page-top">
    <div id="wrapper">
        <?php include '../public/body/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../public/body/navbar.php'; ?>
                <style>
                    #map {
                        height: 400px;
                    }
                </style>
                </head>

                <body>
                    <div id="map"></div>
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                    <script>
                        var map = L.map('map').setView([<?= $lat ?>, <?= $lng ?>], 12); // Coordenadas de Bogotá

                        // Agregar capa de OpenStreetMap
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Colocar marcador en la ubicación
                        L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map)
                            .bindPopup("<?= ($_REQUEST['location'] ?? '') ?>")
                            .openPopup();
                    </script>
            </div>
            <br><br><br>
            <?php include '../public/body/footer.php'; ?>
        </div>
    </div>

</body>

</html>
