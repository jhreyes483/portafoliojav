<?php

class c_array{


   //Quita valores vacios y repetidos  un array o string por comas // c_array::m_limpia_array("232,46,234,123,0,232,2", 'a')
   public static function m_limpia_array($arrayOstrinPorComas, $tipo='a', $organizaKey = true){
      if(is_string($arrayOstrinPorComas)){
         $arrayResult = (array_unique( array_filter(explode(',',$arrayOstrinPorComas))));
      }
      if(is_array($arrayOstrinPorComas)){
         $arrayResult = (array_unique( array_filter($arrayOstrinPorComas)));
      }
      switch ($tipo) {
         case 'a': // Retorna un arreglo sin valores vacíos ni repetidos
            if($organizaKey) $arrayResult =  array_values($arrayResult);
            return $arrayResult;
            break;
         case 's': // Retorna un string sin valores vacíos ni repetidos
            return implode(', ', $arrayResult);
            break;
      }
   }

   public static function m_array_sort_by(&$arrIni, $col, $order = SORT_ASC){
      $arrAux = array();
      foreach ($arrIni as $key=> $row) {
          $arrAux[$key] = is_object($row) ? $row->$col : $row[$col]??'';
          $arrAux[$key] = strtolower($arrAux[$key]);
      }
      array_multisort($arrAux, $order, $arrIni);
      return $arrIni;
  }

}


?>