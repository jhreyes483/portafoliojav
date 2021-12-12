<?php
include_once 'festivos.class.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/incl/mySQLi.class.php');
class c_date{

   public static function m_add_time(string $timestamp, $timeToAdd,  $formato = 'Y-m-d', $espanol = false, $operacion = '+'){
      $timestamp = ($timestamp == "now") ? date($formato) : $timestamp;
      $timeToAdd = explode(' ' . $operacion . ' ', $timeToAdd);
      if ($espanol) foreach ($timeToAdd as $key => $value) $timeToAdd[$key] = self::m_traduce_time($value, false);
      $time      = implode(' ' . $operacion . ' ', $timeToAdd);
      $date      = new DateTime($timestamp);
      $date->add(DateInterval::createFromDateString($time));
      return $date->format($formato);
      /*
      c_date::m_add_time($timestamp,'-1 hora - 4 minutos', 'Y-m-d H:i:s' , true,'-');
      c_date::m_add_time($timestamp,'+1 hora + 4 minutos', 'Y-m-d H:i:s' , true,'+');
      Debe ser  $operacion = +  o $operacion = +
      */
   }

   public static function m_dias_no_habiles( string $fechaI, string $fechaF, $dias =['sábados','domingos','festivos']  , $a = false) {
      $feriados     = $sabados  = $domingos = 0;
      $msg          = '';
      $aFestivos    = $aSabados=$diasFeriados = $aDomingos=  [];
      $fechaInicial = new \DateTime( self::m_format_fecha($fechaI, 'Y-m-d') );
      $fechaFinal   = new \DateTime( self::m_format_fecha($fechaF,  'Y-m-d') );
      $f            = new c_Festivos();
      $festivos    = $f->f_calendario(self::m_format_fecha($fechaI,'Y'));

      while ( $fechaInicial <= $fechaFinal ) {
         ( $fechaInicial->format('l') === 'Saturday' ) ? $sabados++  : $sabados  += 0;
         if( in_array( 'sábados' ,$dias ) && $a && $fechaInicial->format('l') === 'Saturday'  ){ // Crea array con sabados
            $aSabados[] = $fechaInicial->format('Y-m-d');
         }

         ( $fechaInicial->format('l') === 'Sunday' )   ? $domingos++ : $domingos += 0;
         if( in_array( 'domingos' ,$dias ) && $a && $fechaInicial->format('l') === 'Sunday'  ){ // Crea array con domingos
            $aDomingos[] = $fechaInicial->format('Y-m-d');
         }
         //Si está en el array y es sábado o domingo (Se restan esos días)
         if ( array_key_exists(  $fechaInicial->format('Y-m-d'), $festivos  ) ) {         // Crea array con festivos
            if( in_array( 'festivos' ,$dias ) && $a ){
               $aFestivos[] = $fechaInicial->format('Y-m-d');
            }

            $feriados++;
            if ( $fechaInicial->format('l') === 'Saturday' ) {
               $sabados--;
               $msg .= '* El sábado ' . $fechaInicial->format('Y-m-d') . ' fue feriado ';
            }
            if ( $fechaInicial->format('l') === 'Sunday' ) {
               $domingos--;
               $msg .= '* El domingo ' . $fechaInicial->format('Y-m-d') . ' fue feriado ';
            }
            array_push($diasFeriados, $fechaInicial->format('Y-m-d'));
         }
         $fechaInicial->modify('+1 days'); //Incremento de la fecha inicial
      }

      if($a == false)  $r = [
         'feriados'     => (int)$feriados,
         'sabados'      => (int)$sabados, 
         'domingos'     => (int)$domingos,
         'totalDias'    => (int)($feriados + $sabados + $domingos),
         'diasFeriados' => [$diasFeriados],
         'msg'          => $msg
      ];
      if($a){ 
         if(count($aSabados)  >0)  $r['sabados'] = $aSabados;
         if(count($aDomingos) >0) $r['domingos'] = $aDomingos;
         if(count($aFestivos) >0) $r['festivos'] = $aFestivos;
      }
      return $r;
   }

   public static function m_diff_horas($horaI, $horaF, $formato){
      $diff = strtotime($horaF) + strtotime($horaI);
      switch ($formato) {
         case 's':
            return $diff;
            break;
         case 'H':
            return ($diff / 3600);
            break;
      }
      
   }
 

   public static function m_clasifica_horas(string $fechaI, string $fechaF) : array {
      $fechaI = '2021-09-26 17:00:00';
      $fechaF = '2021-09-26 18:30:00';
      // Dominical es igual a festiva
      $por= [ 
         'HeD' =>25,                                   // Extra diurno si  6am a 8:pm (20)
         'HeN' =>75,  // si es fuera de las 8 horas    // Extra nocturno   (21) 9pm a 6am
         'HeDf'=>100,                                  // Hora extra diurna festiva 
         'HeNf'=>150,                                  // Extra festivo nocturna 
         'HN'  =>35,   //                              // Jornada nocturno     
         'HF'  =>75, // aplica para los domingos       // Jornada diurna festivo     
         'HFN' =>110,                                  // Jornada nocturna festiva
      ];
      // var
      $horaI   = self::m_format_fecha($fechaI,'H:i:00');
      $horaF   = self::m_format_fecha($fechaF,'H:i:00');
      $fI      = self::m_format_fecha($fechaI,'Y-m-d');
      $fF      = self::m_format_fecha($fechaF,'Y-m-d'); 
      $diaSig  = date('Y-m-d', strtotime($fechaI .'+1 day'));
      // Bool  dia 
      $bFes    = self::m_is_day_week($fechaI,'festivo');
      $bDom    = self::m_is_day_week($fechaI,'domingo');
      $bNor    = (!$bFes  && !$bDom ? true : false);
      $bMdia   = ($fI == $fF  ? true : false); // mismo día

      $bHeD  = ( (self::m_time_in_interval( '06:00:00','20:00:00', $horaF) && $bMdia) 
      ||         (self::m_time_in_interval( '06:00:00','20:00:00', $horaI) && $bMdia) ? true : false);

      $bHeN  = ( (self::m_time_in_interval( "$fI 21:00:00","$diaSig 06:00:00", $fechaI)) 
      ||         (self::m_time_in_interval( "$fI 21:00:00","$diaSig 06:00:00", $fechaF)) ? true : false);

      c_MySQLi::ver( $bHeD  ,0,1,'bool diurna');
      c_MySQLi::ver( $bHeN,0,1,'bool nocturna');
      c_MySQLi::ver( self::m_human_time(strtotime($fechaF) - strtotime($fechaI))   );
 
      if($bNor){
         $HE = 'Normal';
         if($bHeD){$tipo = 'HeD'; $j ='Diurna';} 
         if($bHeN){$tipo = 'HeN'; $j ='Nocturna';}
      }  
      if($bDom || $bFes ){
         $HE   = ($bDom ? 'Dominical': 'Festivo');
         if($bHeD){ $tipo = 'HeDf'; $j = 'Diurna';} 
         if($bHeN){ $tipo = 'HeNf'; $j = 'Nocturna';}
      } 
      $diff = ((strtotime($fechaF) - strtotime($fechaI))/3600 );
      return  ['HE'=>$HE,'J'=>$j,'t'=>$tipo,'C'=>$diff,'%'=>$por[$tipo]];
   }



   public static function m_dias_habiles(string $fechaI , string $fechaF, $aFestivos= []){
      $fechaI    = new DateTime($fechaI);   //intialize start date
      $fechaF    = new DateTime($fechaF);   //initialize end date
      $interval  = new DateInterval('P1D'); // set the interval as 1 day
      if( empty($aFestivos)) $aFestivos = self::obj('diasFeriados');
      $daterange = new DatePeriod($fechaI, $interval , $fechaF);
      foreach($daterange as $date){
      if($date->format("N") <6 && !in_array($date->format("Y-m-d"),$aFestivos))
      $result[] = $date->format("Y-m-d");
      }
      return $result;
   }

   public static function m_dias_en_rango_time(string $fechaI, string $fechaF,string $returDataEn = 'días',string $recorreEn ='días' , $formato = null, $boolGroup = false){
      $fechaI   =strtotime($fechaI);
      $fechaF   =strtotime($fechaF);

      switch ($recorreEn) {
         case 'minutos': case 'minuto': case 'minute' : case 'minutes' :
            $seg = 60;
            if(!isset($formato)) $formato = 'H:i:s';
         break;
         case 'horas': case 'hora': case 'hour' : case 'hours':
            $seg = 3600;
            if(!isset($formato)) $formato = 'H:i:s';
            break;
         case 'días': case 'día': case 'day' : case 'days' : case 'dias': case 'dia' :
            $seg = 86400;
            if(!isset($formato)) $formato = 'Y-m-d';
            break;
         case 'week': case 'weeks': case 'semana' : case 'semanas';
            $seg = 604800;
            if(!isset($formato)) $formato = 'Y-m-d';
            break;
      }

      for($i=$fechaI; $i<=$fechaF; $i+=$seg){
         switch ($returDataEn) {
            case 'segundos': case 'segundo': case 'second' : case 'seconds':
               if($boolGroup)             $aFechas[date('s', $i)][]  = date($formato, $i);
               if($boolGroup == false)    $aFechas[date('s', $i)]    = date($formato, $i);
               break;

            case 'minutos': case 'minuto': case 'minutes' : case 'minute':
               if($boolGroup)             $aFechas[date('i', $i)][]  = date($formato, $i);
               if($boolGroup == false)    $aFechas[date('i', $i)]    = date($formato, $i);
             break;

            case 'hora': case 'horas': case 'hour' : case 'hours':
               if($boolGroup)             $aFechas[date('H', $i)][]  = date($formato, $i);
               if($boolGroup == false)    $aFechas[date('H', $i)]    = date($formato, $i);
            break;

            case 'días': case 'día': case 'day' : case 'days': case 'dias': case 'dia' :
               if($boolGroup)             $aFechas[date('Y-m-d', $i)][]  = date($formato, $i);
               if($boolGroup == false)    $aFechas[date('Y-m-d', $i)]    = date($formato, $i);
               break;
            case 'semanas': case 'semana': case 'week' : case 'weeks':
            if($boolGroup)             $aFechas[date('W', $i)][]  = date($formato, $i);
            if($boolGroup == false)    $aFechas[date('W', $i)]    = date($formato, $i);
               break;
            case 'meses': case 'mes': case 'months' : case 'month':
            if($boolGroup)               $aFechas[date('m', $i)][]  = date($formato, $i);
               if($boolGroup == false)   $aFechas[date('m', $i)]    = date($formato, $i);
               break;
         }
      }
      return $aFechas;
   }

   //Transforma a una fecha legible un timestamp de forma "2019-06-16 22:52:00"   else   c_date::m_format_time($timestamp, 'H:m');
   public static function m_format_fecha(string $timestamp, string $formato = 'string'): string{
      if ($formato == 'string') { // Domingo 16 de Junio del 2019
         $timestamp = substr($timestamp, 0, 10);
         $numeroDia = date('d', strtotime($timestamp));
         $mes       = date('m', strtotime($timestamp));
         $anio      = date('Y', strtotime($timestamp));
         $diaSem    = date('w', strtotime($timestamp));
         $meses     = self::obj('meses');
         $dias      = self::obj('dias');
         $nombreMes = $meses[abs($mes)];
         $nombredia = $dias[$diaSem];
         return $nombredia . " " . $numeroDia . " de " . $nombreMes . " del " . $anio;
      } else {
         return date($formato, strtotime($timestamp));
      }
   }

   private static function m_format_time($y = 0, $m = 0, $d = 0, $h = 0, $i = 0, $s = 0, $diff = 0, $formato){
      //$formato = 'a';
      switch ($formato) {
         case 'a';
            $r['H l']           =  ($h > 0 ? $h . ' horas ' : '') . ($i > 0 ? $i . ' min ' : '') . ($s > 0 ? $s . ' seg ' : '');
            $r['H c']           =  ($h > 0 ? $h . 'h ' : '')    . ($i > 0 ? $i . 'm ' : '') .   ($s > 0 ? $s . 's ' : '');
            $r['H:i c']         =  ($h > 0 ? $h . 'h ' : '') . ($i > 0 ? $i . 'm ' : '');
            $r['Y/m/d H:m:s l'] =  ($y > 0 ? $y . ' años ' : '') . ($m > 0 ? $m . ' meses ' : '') . ($d > 0 ? $d . ' días ' : '') . ($h > 0 ? $h . ' horas ' : '') . ($i > 0 ? $i . ' min ' : '') . ($s > 0 ? $s . ' seg ' : '');
            $r['Y/m/d H:m:s c'] =  ($y > 0 ? $y . 'a ' : '')    . ($d > 0 ? $d . 'd ' : '') . ($m > 0 ? $m . 'm ' : '') . ($h > 0 ? $h . 'h ' : '') . ($i > 0 ? $i . 'm ' : '') . ($s > 0 ? $s . 's ' : '');
            $r['s']             =    $diff;
            $r['decim h']       = ($diff) / 3600;
            $r['decim m']       = ($diff) / 60;
            $r['dig']           =  ($h > 10 ? $h : '0' . $h) . ':' . ($i > 10 ? $i : '0' . $i) . ':' . ($s > 10 ? $s : '0' . $s);
            break;
         case 'H l':
            $r = ($h > 0 ? $h . ' horas ' : '') . ($i > 0 ? $i . ' min ' : '') . ($s > 0 ? $s . ' seg ' : '');
            break;

         case 'H c':
            $r = ($h > 0 ? $h . 'h ' : '')    . ($i > 0 ? $i . 'm ' : '') .   ($s > 0 ? $s . 's ' : '');
            break;
         case 'H:i c':
            $r = ($h > 0 ? $h . 'h ' : '') . ($i > 0 ? $i . 'm ' : '');
            break;
         case 'Y/m/d H:m:s l':
            $r = ($y > 0 ? $y . ' años ' : '') . ($m > 0 ? $m . ' meses ' : '') . ($d > 0 ? $d . ' días ' : '') . ($h > 0 ? $h . ' horas ' : '') . ($i > 0 ? $i . ' min ' : '') . ($s > 0 ? $s . ' seg ' : '');
            break;
         case 'Y/m/d H:m:s c':
            $r = ($y > 0 ? $y . 'a ' : '') . ($d > 0 ? $d . 'd ' : '') . ($m > 0 ? $m . 'm ' : '') . ($h > 0 ? $h . 'h ' : '') . ($i > 0 ? $i . 'm ' : '') . ($s > 0 ? $s . 's ' : '');
            break;
         case 'dig':
            $r = ($h > 10 ? $h : '0' . $h) . ':' . ($i > 10 ? $i : '0' . $i) . ':' . ($s > 10 ? $s : '0' . $s);
            break;
         case 's':
            $r =  $diff;
            break;
         case 'decim h':
            $r =  ($diff) / 3600;
            break;
         case 'decim m';
            $r = ($diff) / 60;
            break;
      }
      return $r;
   }

   public static function m_human_time($input_seconds, string $formato = 'a'){
      $days      = floor($input_seconds / 86400);
      $remainder = floor($input_seconds % 86400);
      $hours     = floor($remainder / 3600);
      $remainder = floor($remainder % 3600);
      $minutes   = floor($remainder / 60);
      $seconds   = floor($remainder % 60);
      return     self::m_format_time(0, 0, $days, $hours, $minutes, $seconds, $input_seconds, $formato);
   }

   public static function m_is_day_week( string  $fecha , string $dia) : bool{
      if($dia == 'festivo'){
         $f         = new c_Festivos();
         $festivos  = $f->f_calendario(self::m_format_fecha($fecha,'Y'));
         $b         = ( array_key_exists(  self::m_format_fecha($fecha, 'Y-m-d'), $festivos ));
      }else{
         $dias      = self::obj('dias');
         $b         = ($dias[self::m_format_fecha($fecha,'w')]  == ucfirst($dia) ? true : false );
      }
      return $b; 
   }

   public static function obj($tipo){
      switch ($tipo) {
         case 'meses':
            return ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            break;
         case 'dias':
            return ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado'];
            break;
         case 'diasFeriados': 
            return [
               '01-01', //Año nuevo
               '04-19', //Declaración de la Independencia,
               '05-01', //Día del trabajador
               '06-24', //Batalla de Carabobo
               '07-05', //Día de la independencia
               '07-24', //Natalicio de Simón Bolívar
               '10-12', //Día de la Resistencia Indígena
               '12-24', //Víspera de Navidad
               '12-25', //Navidad
               '12-31', //Fiesta de Fin de Año
             ];
            break;

           // case 'diasFeriados':
           //    
           //    break;
      }

   }

   public static function  m_time_diff(string $timesInicial, string $timesFinal, string $formato = 'a'){
      if (strtotime($timesInicial) > strtotime($timesFinal)) {
         if ($formato == 'a') ['status' => 'error', 'msg' => 'error fecha fina menor que la inicial'];
      } else {
         $r = 0;
      }
      $timestamp1 = ($timesInicial=='now') ? date("Y-m-d  H:i:s") : $timesInicial;
      $timestamp2 = ($timesFinal=='now')   ? date("Y-m-d  H:i:s") : $timesFinal;
      $date1      = new DateTime($timestamp1);
      $date2      = new DateTime($timestamp2);
      $interval   = $date1->diff($date2);
      $diff       = strtotime($timesFinal) - strtotime($timesInicial);
      return      self::m_format_time($interval->y, $interval->m, $interval->d, $interval->h, $interval->i, $interval->s, $diff, $formato);
   }

   public static function m_time_in_interval(string $timeI, string $timeF, string $timeAevaluar): bool{
      // Si esta en el intermavalo de las dos fechas retorna true
      return (strtotime($timeAevaluar) >= strtotime($timeI) && strtotime($timeAevaluar) <= strtotime($timeF)) ? true : false;
   }

   public static function m_traduce_time(string $time, bool $toEspan = true): string{
      // c_date::m_traduce_time('1 days'); return 1 día
      // Si $toEspan es falso retorna de espa?ol a ingles
      // Separo el numero del texto
      $time   = explode(" ", $time);
      $number = $time[0];
      $string = $time[1];
      // Creamos los arays con sus traducciones
      $es     = ['segundo', 'minuto', 'hora', 'día', 'semana', 'mes', 'año', 'segundos', 'minutos', 'horas', 'días', 'semanas', 'meses', 'años'];
      $en     = ['second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years'];
      $string = ($toEspan) ? $es[array_search($string, $en)] : $en[array_search($string, $es)];
      return $number . " " . $string;
   }
}


$fechaInicio=("2021-08-21 13:18:38");
$fechaFin=("2021-08-21 16:20:38");

//$aFechas = c_date::m_time_diff($fechaInicio, $fechaFin, 'decim h');
//$aFechas = c_date::m_human_time(c_date::m_time_diff($fechaInicio, $fechaFin)  );
//$aFechas =  c_date::m_dias_en_rango_time($fechaInicio, $fechaFin, 'dias','horas','H:i:s', true );
//echo '<pre>';
//print_r($r);
//$aFechas = c_date::m_dias_en_rango_time($fechaInicio,  $fechaFin,'semanas','dias','y-m-d',true);
//$aFechas = c_date::m_dias_no_habiles('01-03-2021','20-09-2021',['sábados','domingos','festivos'] , false);
//$aFechas = c_date::m_dias_habiles('01-03-2021','20-09-2021');

echo '<pre>';
print_r($aFechas );
//echo c_date::m_format_fecha('18-09-2021', 'Y-m-d' );



?>
