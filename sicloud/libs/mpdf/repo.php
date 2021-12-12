/>
<?php
@session_start();
require_once __DIR__ . '/vendor/autoload.php';

$stylesheet = file_get_contents('css/bootstrap.min.css');
//echo __DIR__.'/css/bootstrap.min.css';




$mpdf = new \Mpdf\Mpdf();
$html = $_SESSION['doc'];
// $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->Output();
exit;

?>