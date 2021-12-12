<?php
/*************************************************************************************************
 *							Reestructura la vista, trae datos y archivos necesarios desde el controller
 *************************************************************************************************/

class View{
   private $_controlador;
   private $_params;
   private $_js;
   private $_css;
   private $_img;
   private $_ico;

   public function __construct(Request $peticion){
      $this->_controlador  = $peticion->getControlador();
      $this->_params = $peticion->getParam();
      $this->_js  = [];
      $this->_css = [];
      $this->_img = [];
      $this->_ico = [];
   }



   public function renderizar($vista, $nav = null, $finaliza=0, $fondo= 0){   
      //require_once APP_LIBS. 'notificacion.phtml';

      // por defect carga con nav construido por perfil
      // 0 = no hay nav, 
      // 1 = nav video index con js de url
      // 2 = nav video sin js 




   	$js  = count($this->_js)? $this->_js:[];
      $css = count($this->_css)? $this->_css:[];
      $img = count($this->_img)? $this->_img: [];
      $ico = count($this->_ico)? $this->_ico:[];

      //recursos gen�ricos
      $_layoutParams = array(
         'ruta_css'  => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/css/',
         'ruta_js'   => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/js/',
         'ruta_img'  => 	BASE_URL .'public/'.DEFAULT_LAYOUT.'/img/',
         'ruta_ico'  =>  BASE_URL .'public/'.DEFAULT_LAYOUT.'/ico/',
 //        'menu'      => $menu,
         'js'        => $js,
         'img'       => $img,
         'ico'       => $ico,
         'css'       => $css
      );

      
      $rutaView ='_views/'. $this->_controlador . '/' .$vista.'.phtml';
      //echo '<br>ruta -> '.$rutaView.'<br>';
      //echo 'vista ->'. $vista.'<br>';
     

        
         if(is_readable($rutaView)){
            include_once ROOT.'_views/index/header.php';

 

      
      if(is_readable($rutaView)){
         include_once ROOT.'_views/index/header.php';
         

         if(!isset($nav)){  
            if(isset($_SESSION['usuario'])){
               require_once APP_LIBS.'nav/N.php';
            }else{
               require_once APP_LIBS.'nav/P.php';
            }
         }
      }
   
         
      
 
      include_once  $rutaView;
      include_once ROOT.'_views/index/footer.php';
    	}else{
      	throw new Exception('Error de Vista - ');
      }
      if($finaliza!=0) die();
   }

	public function setCss(array $css){
		if(is_array($css) && count($css)){
         foreach( $css as $c ){
            $this->_css[] = $c.'.css';
         }
     	}else{
      	throw new Exception('Error de css');
    	}
	}

   public function setJs(array $js){
      if(is_array($js) && count($js)){
        foreach ($js as $j ){
           $this->_js[] = $j.'.js';
        }
      }else{
         throw new Exception('Error de js');
      }
   }

   public function setImg(array $img){
      if(is_array($img) && count($img)){
         for($i=0; $i < count($img); $i++){
            $this->_img[] = $img[$i];
         }
      }else{
         throw new Exception('Error de imagen');
      }
   }

   public function setIcon(array $ico){
      if(is_array($ico) && count($ico)){
         for($i=0; $i < count($ico); $i++){
            $this->_ico[] = $ico[$i]. '.png';
         }
      }else{
         throw new Exception('Error de icono');
      }
   }

   public function setTable( $idTabla , $ordenPorDefecto = null , $filaSinOrden = null){
    
  //    echo "
  //    <script>
  //  $(document).ready(function() {
  //       $('table th i').addClass( 'fas fa-arrows-alt-v')
  //      $('table').addClass('tablesorte table-hover bg-white table-sm table-bordered table-striped')
  //      $('table thead').addClass('shadow-sm')
  //      $('#$idTabla').tablesorter({
  //          widgets: ['zebra']";
  //         // echo 'ordenDefect ->'. $ordenPorDefecto;
  //          if( isset($ordenPorDefecto)) {echo"
  //          ,
  //          sortList: [
  //              [$ordenPorDefecto , 1]
  //          ]";
  //          }
  //          if( isset($filaSinOrden) ){
  //          echo "
  //          ,
  //          headers: {
  //             $filaSinOrden: {
  //                  sorter: false
  //              }
  //          }
  //          ";
  //       }

   //      echo "
   //     });
   // });
   //</script>
   //   ";


   }
}


?>
