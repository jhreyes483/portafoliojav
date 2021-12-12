<?php
class c_opera{
   

   public static function m_divi($n1 , $n2){
      if( $n1 == 0 || $n2 == 0 ) return 0;
      return ($n1 / $n2);
   }

   public static function m_porc( $array, $tot, $posicion, $decimas=1, $tipo =1){
      if( $array == 0 || $tot == 0 ) return 0;
      switch ($tipo) {
         case 1:
            $r = 100 *(array_sum(array_column($array, $posicion)))/$tot;
            break;
         case 2:
            $r = (($array*100)/$tot);
            break;         
      }
      return ($r != 100 && $r != 0 ?(number_format($r,$decimas)): $r);  
   }
   
   public static function m_sum( $array, $posicion){
      return array_sum(array_column($array, $posicion));
   }



}


?>