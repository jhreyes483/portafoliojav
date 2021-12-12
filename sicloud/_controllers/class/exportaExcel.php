<?
class c_expAexcel{
   function __construct($title='Reporte Ineditto'){
      include_once($_SERVER['DOCUMENT_ROOT'] . '/_classes/phpExcel/xlsxwriter.class.php');
      $this->writer = new XLSXWriter();
      $this->writer->setAuthor('Software Ineditto');
      $this->writer->setCompany('Grupo Ineditto SAS');
      $this->writer->setDescription('Descargado por: '.$_SESSION['s_empnombre']);
      $this->writer->setTitle($title);
   }

   function genera($c, $d, $o, $s, $f='ineditto.xlsx', $n='Hoja1', $cabMerged=0){ //cabezote, datos,  opciones, styles, filename, name
      
      $d = $this->utf8_converter($d);
      if($s=='') $s = [
         'font'     =>'Calibri',
         'font-size'=>11,
         'font-style'=>'bold', 
         'fill'      =>'#0070C0', 
         'color'     =>'#FFF',  
         'halign'    =>'center'
      ];
     
      if($cabMerged>0){
         $cabTit            = ['font'=>'Corbel', 'font-size'=>20, 'font-style'=>'bold', 'fill'=>'#1F497D', 'color'=>'#FFC000', 'halign'=>'center' ];
         $tit[]             = array_shift($d);
         $tit[]             = array_shift($d);
         $o['suppress_row'] = true;
         //$c      = ['string', 'string', 'money', '#,##0', 'money', 'money'] ;
         $this->writer->writeSheetHeader($n, $c, $s+$o); //este molesta
         $this->writer->writeSheetRow   ($n, $tit[0], $cabTit);
         $this->writer->writeSheetRow   ($n, $tit[1], $s+$o); //Envío las opt para que cuadre los anchos
         $this->writer->markMergedCell  ($n, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = $cabMerged);
      }else{
         //include_once($_SERVER[ 'DOCUMENT_ROOT' ] . '/incl/mySQLi.class.php');
         $this->writer->writeSheetHeader($n, $c, $o+$s);
         //die('ddd');
      }

      foreach($d as $row) $this->writer->writeSheetRow($n, $row);
      //die($f);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header("Content-Disposition: attachment; filename=$f");
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: no-cache');
      header('Expires: 0');
      
      $this->writer->writeToStdOut();
   }
   
   private function utf8_converter($array){
      array_walk_recursive($array, function(&$item, $key){
         if(!mb_detect_encoding($item, 'utf-8', true))
            $item = utf8_encode($item);
      });
      return $array;
   }
}