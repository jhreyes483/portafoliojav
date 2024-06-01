<!DOCTYPE html>
<?php
$keywordsL = 'Impermeabilizacion casas, Pintura, Construcción mallorca, Empresa de reformas integrales, reformas de cocinas, Especialistas en reformas de pisos, Construcción mallorca, Reformas mallorca, Aislamientos mallorca, Albañilería mallorca, Arquitectos mallorca, Carpintería de aluminio mallorca, pvc mallorca, Electricistas mallorca, Fontanería mallorca, Herrerías mallorca, Materiales de construcción mallorca, Suelos y pavimentos mallorca, Piscinas mallorca, Pladur mallorca, Rehabilitación de fachadas mallorca, Hogar mallorca, Reparaciones mallorca, Impermeabilizacion, Pintura, Pintores, Pintor, Pintura de fachadas, Pintura de casas, Pladur, Reforma de interiores, Diseño de interiores, Fontanería, Mantenimiento de Jardines, Construcciones y reformas, Reforma tejados, Reforma de cubiertas, Reforma techos, Reformas de pisos, Construcción de Jardines, Reformas de baños, jardineria en mallorca, refomra de baños en mallorca, reforma de casas en mallorca, plomeria en mallorca, pintor en mallorca, soluciones integrales en mallorca';
$keywordsC = 'Mallorca, soluciones integrales, construcción, jardinería, limpieza, reformas, empresa, servicios, Manacor, Soller, piscinas, baños, cocinas, tejados, cubiertas, techos, pladur, interiores, diseño, fontanería, impermeabilización, pintura, fachadas, casas';
$keywordsJ = 'Reformas de pisos, Construcción de Jardines, Reformas de baños, Reformas de cocinas, Reformas integrales, Reformas Manacor, Mantenimiento, Mantenimiento piscinas, Limpieza piscinas, Reformas soller, Construcción soller, Mantenimiento de Jardines, Construcciones y reformas, Reforma tejados, Reforma de cubiertas, Reforma techos, Pladur, Reforma de interiores, Diseño de interiores, Fontanería, Impermeabilizacion ,Impermeabilizacion casas, Pintura, Pintores, Pintor, Pintura de fachadas ,Pintura de casas';
$descript = 'Empresa especializada en soluciones integrales en Mallorca de construcción, jardinería y limpieza. Ofrecemos servicios de alta calidad para todo tipo de reformas, desde pequeñas mejoras hasta proyectos completos. Contáctanos para transformar tu hogar o espacio comercial.';
$anexDescript = 'Servicios de: Reformas de pisos, Construcción de Jardines, Reformas de baños, Reformas de cocinas';
//$anecDescript2 = 'reforma de  transformar baños y cocinas. ¡Descubre cómo podemos mejorar tu espacio hoy mismo!';

   $metadata = [
        'keywords' => [
            'l' => $keywordsL,
            'c' => $keywordsC,
            'j' => $keywordsJ
            ],
        'descript' => [
            'l' => $descript . 'Servicios de: ' . $keywordsL,
            'c' => $descript . 'Servicios de: ' . $keywordsC,
            's' => $descript
            ]
        ];

    ?>


<html lang="es">

<head>
   <title><?= $this->titulo ?></title>
    <meta name="google-site-verification" content="5HG4fs0h2NiX51oAzIsZ4uyz5LjHc7pHW5vi4bZod0Q" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Metadata para SEO -->
  <meta name="description" content="<?= $descript ?>">
    <meta name="keywords" content="<?=  $metadata['keywords']['l']  ?>">
   <meta name="author" content="Soluciones integrales mallorca">
   <meta name="publisher" content="Soluciones integrales mallorca">
   <meta name="robots" content="index, follow">

   <!-- Metadata para Open Graph (Facebook) -->
   <meta property="og:title" content="Soluciones Integrales Mallorca- de Construcción, Jardinería y Limpieza">
   <meta property="og:description" content="Empresa especializada en soluciones integrales de construcción, jardinería y limpieza en Mallorca. Ofrecemos servicios de alta calidad para todo tipo de reformas, desde pequeñas mejoras hasta proyectos completos. Contáctanos para transformar tu hogar o espacio comercial.">
   <meta property="og:image" content="<?= LOGOC ?>">
   <meta property="og:url" content="https://solucionesintegralesmallorca.com/">
   <meta property="og:site_name" content="Soluciones Integrales Mallorca - Hacemos realidad la mejor versión de tu hogar">
   <meta property="og:type" content="website">
   <meta property="og:locale" content="es_ES">
   <!-- Metadata para Twitter -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="Soluciones Integrales Mallorca - Construcción, Jardinería y Limpieza">
   <meta name="twitter:description" content="Empresa especializada en soluciones integrales de construcción, jardinería y limpieza en Mallorca. Ofrecemos servicios de alta calidad para todo tipo de reformas, desde pequeñas mejoras hasta proyectos completos. Contáctanos para transformar tu hogar o espacio comercial.">
   <meta name="twitter:image" content="<?= LOGOC ?>">

   <!-- Otros metadatos opcionales -->
   <meta name="theme-color" content="#fffff">
   <link rel="canonical" href="https://solucionesintegralesmallorca.com/">
   <link rel="alternate" hreflang="es" href="https://solucionesintegralesmallorca.com/">

   <link rel="shortcut icon" href="<?= LOGOC ?>" type="image/x-icon">
   
    
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2PDCEE4GK5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2PDCEE4GK5');
</script>

   <?php



    if (isset($_layoutParams['css']) && count($_layoutParams['css'])) {
        foreach ($_layoutParams['css'] as $css) {
            echo "\t" . '<link href="' . $_layoutParams['ruta_css'] . $css . '" rel="stylesheet" >' . PHP_EOL;
        }
    }


    if (isset($_layoutParams['js']) && count($_layoutParams['js'])) {
        foreach ($_layoutParams['js'] as $js) {
            echo "\t" . '<script src="' . $_layoutParams['ruta_js'] . $js . '"></script>' . PHP_EOL;
        }
    }




    ?>

</head>
</body>
