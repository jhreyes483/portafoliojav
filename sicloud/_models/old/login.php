<?
class login extends Model{
   function __construct(){
      parent::__construct();
      $this->_odbc = $this->loadModel('mySQL', false, 'ineditto'); 
      $con  = $this->loadModel('consultas.admon', 'c_inicial');
   }
   
}