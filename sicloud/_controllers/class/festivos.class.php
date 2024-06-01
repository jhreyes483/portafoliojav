<?php

class c_Festivos
{
    private $arrFes;
    function __construct($year = '')
    {
        if ($year == '') {
            $year = date('Y');
        }
        $this->arrFes = $this->f_calendario($year);
    }

    function f_calendario($y)
    {

        $f = array(
         '2017' => [
            '2017-01-01' => 'A�o Nuevo',
            '2017-01-09' => 'D�a de los Reyes Magos',
            '2017-03-20' => 'D�a de San Jos�',
            '2017-04-09' => 'Domingo de Ramos',
            '2017-04-13' => 'Jueves Santo',
            '2017-04-14' => 'Viernes Santo',
            '2017-04-16' => 'Domingo de Resurrecci�n',
            '2017-05-01' => 'D�a del Trabajo',
            '2017-05-29' => 'Ascensi�n de Jes�s',
            '2017-06-19' => 'Corpus Christi',
            '2017-06-26' => 'Sagrado Coraz�n de Jes�s ',
            '2017-07-03' => 'San Pedro y San Pablo',
            '2017-07-20' => 'D�a de la Independencia',
            '2017-08-07' => 'Batalla de Boyac�',
            '2017-08-21' => 'Asunci�n de la Virgen',
            '2017-10-16' => 'D�a de la Raza',
            '2017-11-06' => 'Todos los Santos',
            '2017-11-13' => 'Independencia de Cartagena',
            '2017-12-08' => 'Inmaculada Concepci�n',
            '2017-12-25' => 'Navidad'],

         '2018' => [
            '2018-01-01' => 'A�o Nuevo',
            '2018-01-08' => 'D�a de los Reyes Magos',
            '2018-03-19' => 'D�a de San Jos�',
            '2018-03-29' => 'Jueves Santo',
            '2018-03-30' => 'Viernes Santo',
            '2018-05-01' => 'D�a del Trabajo',
            '2018-05-14' => 'Ascensi�n de Jes�s',
            '2018-06-04' => 'Corpus Christi',
            '2018-06-11' => 'Sagrado Coraz�n de Jes�s ',
            '2018-07-02' => 'San Pedro y San Pablo',
            '2018-07-20' => 'D�a de la Independencia',
            '2018-08-07' => 'Batalla de Boyac�',
            '2018-08-20' => 'Asunci�n de la Virgen',
            '2018-10-15' => 'D�a de la Raza',
            '2018-11-05' => 'Todos los Santos',
            '2018-11-12' => 'Independencia de Cartagena',
            '2018-12-08' => 'Inmaculada Concepci�n',
            '2018-12-25' => 'Navidad'],

         '2019' => [
               '2019-01-01' => 'A�o Nuevo',
               '2019-01-07' => 'D�a de los Reyes Magos',
               '2019-03-25' => 'D�a de San Jos�',
               '2019-04-18' => 'Jueves Santo',
               '2019-04-19' => 'Viernes Santo',
               '2019-05-01' => 'D�a del Trabajo',
               '2019-06-03' => 'Ascensi�n de Jes�s',
               '2019-06-24' => 'Corpus Christi',
               '2019-07-01' => 'Sagrado Coraz�n de Jes�s ',
               '2019-07-01' => 'San Pedro y San Pablo',
               '2019-07-20' => 'D�a de la Independencia',
               '2019-08-07' => 'Batalla de Boyac�',
               '2019-08-19' => 'Asunci�n de la Virgen',
               '2019-10-14' => 'D�a de la Raza',
               '2019-11-04' => 'Todos los Santos',
               '2019-11-11' => 'Independencia de Cartagena',
               '2019-12-08' => 'Inmaculada Concepci�n',
               '2019-12-25' => 'Navidad'],

         '2020' =>
               ['2020-01-01' => 'A�o Nuevo',
               '2020-01-06' => 'D�a de los Reyes Magos',
               '2020-03-23' => 'D�a de San Jos�',
               '2020-04-09' => 'Jueves Santo',
               '2020-04-10' => 'Viernes Santo',
               '2020-05-01' => 'D�a del Trabajo',
               '2020-05-25' => 'D�a de la Ascenci�n',
               '2020-06-15' => 'Corpus Christi',
               '2020-06-22' => 'Sagrado Coraz�n de Jes�s ',
               '2020-06-29' => 'San Pedro y San Pablo',
               '2020-07-20' => 'D�a de la Independencia',
               '2020-08-07' => 'Batalla de Boyac�',
               '2020-08-17' => 'Asunci�n de la Virgen',
               '2020-10-12' => 'D�a de la Raza',
               '2020-11-02' => 'Todos los Santos',
               '2020-11-16' => 'Independencia de Cartagena',
               '2020-12-08' => 'Inmaculada Concepci�n',
               '2020-12-25' => 'Navidad'],

            '2021' =>
               ['2021-01-01' => 'A�o Nuevo',
               '2021-01-11' => 'D�a de los Reyes Magos',
               '2021-03-22' => 'D�a de San Jos�',
               '2021-04-01' => 'Jueves Santo',
               '2021-04-02' => 'Viernes Santo',
               '2021-05-01' => 'D�a del Trabajo',
               '2021-05-17' => 'Ascensi�n de Jes�s',
               '2021-06-07' => 'Corpus Christi',
               '2021-06-14' => 'Sagrado Coraz�n de Jes�s ',
               '2021-07-05' => 'San Pedro y San Pablo',
               '2021-07-20' => 'D�a de la Independencia',
               '2021-08-07' => 'Batalla de Boyac�',
               '2021-08-16' => 'Asunci�n de la Virgen',
               '2021-10-18' => 'D�a de la Raza',
               '2021-11-01' => 'Todos los Santos',
               '2021-11-15' => 'Independencia de Cartagena',
               '2021-12-08' => 'Inmaculada Concepci�n',
               '2021-12-25' => 'Navidad']
         );
        return $f[$y];
    }

    function f_esFestivo($fecha, $fiesta = 0)
    {

        if (is_numeric($fecha)) {
            $fecha = date('Y-m-d', $fecha);
        }
        if (!$this->esFecha($fecha)) {
            return false;
        }
        $val = 0;
        $dia = date('N', strtotime($fecha));
        if ($dia == 7) {
            $val = 1;
        } //Es Festivo
        if ($dia == 6) {
            $val = 2;
        } //Es S�bado

        if (array_key_exists($fecha, $this->arrFes)) {
            $val = 1;
        }

        if ($fiesta == 0) {
            return $val;
        } else {
            return [$val, $this->arrFes[$fecha] ?? ''];
        }
    }

    function esFecha($fecha)
    {

        return (bool)strtotime($fecha);
    }
}
?>


?>
