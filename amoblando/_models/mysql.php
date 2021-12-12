
<?php
if(!isset($_SESSION['s_vEmp'])) @session_start();
if($_SERVER['SCRIPT_NAME']== '/incl/mySQLi.class.php') die();

#include_once($_SERVER['DOCUMENT_ROOT'] . '/vieneDelServer.php');


if (!isset($_SESSION['s_vEmp']) || $_SESSION['s_vEmp']=='' || !isset($_SESSION['s_sysIneditto'])) {
	die('<script> alert("Su sesión ha caducado, por favor ingrese de nuevo.")
		self.location="/";
	</script>');
}


class c_MySQLi extends mysqli{
	public $conexion; 
	function __construct($datos=''){
		
      if(!isset($this->conexion)){
         //if($datos=='') $datos = $_SESSION['s_sysIneditto'].'/datos_conex.php';
			if($datos=='') $datos = ($_SERVER['DOCUMENT_ROOT'] . '/incl/datos_conex5.php');
         include($datos); //egc No usar include_once, al llamar mas de 1 vez las var. no aparecen
         $database = $_SESSION['s_vEmp']; 
         $this->conexion = mysqli_connect($hostname_conn, $username_conn, $password_conn) or die('Se genero un error de acceso '. __LINE__);
			mysqli_select_db($this->conexion, $database) or die('Se genero un error de conexion /02');
		}
	}
	
	function __destruct(){
		$this->conexion->close();
	}

	public function m_ejecuta($sql){
      $this->actualizaHits();
		$resultado = mysqli_query($this->conexion, $sql);
      $this->actualizaHits();
		if($resultado){
			return $resultado; 
		}else{
			$errorString = mysqli_error($this->conexion); //defino antes de anular la transaccion
			$errorNumber = mysqli_errno($this->conexion);
			$this->m_anulaTRANS();
			#require_once($_SESSION['s_sysIneditto']. '/capturaErrorI.php'); 
			die("<br>$sql $errorString");
		}
	}
	
	public function m_trae_lista($rs){ 
		return mysqli_fetch_assoc($rs);
	}
	
	public function m_trae_array($sql, $tipo=0){ 
		$rs	= $this->m_ejecuta($sql);
		if ($rs) {
			$i = 0;
			$data = array();
			##Retorna un Objeto 
			if($tipo<2){
				if($tipo==0){
					while ($result = mysqli_fetch_row($rs)) {
						$data[$i] = $result;
						$i++;
					}
				}else{ //el indice del arreglo es el nombre del campo
					while ($result = mysqli_fetch_assoc($rs)) {
						$data[$i] = $result;
						$i++;
					}
				}
			
				mysqli_free_result($rs);
				
				$query = new stdClass();
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows = $i;
				
				unset($data);
			}else{ //Retorna un array donde el indice es el primer campo
				while ($result = mysqli_fetch_row($rs)) {
					$query[$result[0]] = $result[1];
				}	
			}
			return $query;	
		} else {
			return true;
		}
	}
	
	public function m_trae_row($rs){ 
		return mysqli_fetch_row($rs);
	}
	
	public function m_num_rows($rs){ 
		return mysqli_num_rows($rs);
	}
	
	public function m_afectadas(){ 
		return mysqli_affected_rows($this->conexion);
	}
	
	public function m_ultInsertado(){ 
		return mysqli_insert_id($this->conexion);
	}
	
	public function m_empiezaTRANS(){ 
		$null = mysqli_query($this->conexion, 'START TRANSACTION');
		return mysqli_query($this->conexion, 'BEGIN');	
	}
	
	public function m_anulaTRANS(){
		return mysqli_query($this->conexion, 'ROLLBACK');
	}
	
	public function m_confirmaTRANS(){
		return mysqli_query($this->conexion, 'COMMIT');
	}
	public function m_error(){
		return mysqli_error($this->conexion);
	}
	public function m_error_no(){
		return mysqli_errno($this->conexion);
	}
	public function m_escape($str){
		return mysqli_real_escape_string($this->conexion,$str);
	}
	
   static function fNum($v, $d=2, $sd='.', $sm=''){
      $nFor = sprintf("%.{$d}f", $v); 
      return $nFor;
   }

	function actualizaHits(){
      if(isset($_SESSION['s_hits'])){
         foreach($_SESSION['s_hits'] as $s=>$m){ 
            foreach($m as $p=>$h){
               if($h>0){
                  $sql = 'INSERT dt_sys_hits VALUES("'.$s.'", "'.$p.'", "'. date('Y-m-d') .'", '.$h.')
                     ON DUPLICATE KEY UPDATE hits = hits+'.$h;
                  mysqli_query($this->conexion, $sql);
                  $_SESSION['s_hits'][$s][$p] = 0;
               }
            }
         }
      }
   }
   
   
	public function m_clean($input){
		if($input === true || $input === false || $input === null){ # is true, false, or null
			return $input;
		}
		
		if(is_array($input)){ # is array
			foreach($input as $key => $val){
				# sanitize both the keys and the values for good measure
				$clean_key          = self::clean($key);
				$input[$clean_key]  = self::clean($val);
			}
		}
		else { # is scalar
			$input = mysqli_real_escape_string($this->conexion, htmlspecialchars(trim($input), ENT_QUOTES, 'ISO-8859-1', false));
		}
		return $input;
	}
   
   

   static function ver($dato, $sale=0, $bg=0, $tit='', $float= false, $email=''){
      switch ($bg){
         case 1:  $bgColor = 'b0ffff'; break;
         case 2:  $bgColor = 'd0ffb9'; break;
         default: $bgColor = 'ffcfcd';    break;
      }
      if($_SERVER['HTTP_HOST']=='itt.kom' || $_SERVER['HTTP_HOST']=='javier.kom')
      {
         echo '<div style="background-color:#' . $bgColor . '; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding: 0 7px 7px 7px; border-radius:7px; margin-top:10px; ">';
         echo '<h2 style="padding: 5px 5px 5px 10px;	margin: 0 -7px; color: #FFF; background-color: #FF6F00; border-radius: 6px 6px 0 0; display:flex"><img src="/ico/debugging.png">&nbsp;Debugging for: '.$tit.'</h2>';
         if(is_array($dato) || is_object($dato) ){
            echo '<pre>'; print_r($dato); echo '</pre>'; 
         }else{
            if(isset($dato)){
               echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
            }else{
               echo 'LA VARIABLE NO EXISTE';
            }
         }
         echo '</div>';
         if($sale==1) die();
         if($email!='') mail('soporte@itt.com.co', 'SQL', $dato, '');
      }
   }





}


?>