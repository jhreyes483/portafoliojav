<?php

class homeController extends Controller {
	public function __construct(){
		parent::__construct();
	}
	//
	public function index(){
      $this->_view->setCss(['carousel', 'bootstrap.min', 'fontawesome-all', 'ineditto']);
      $this->_view->setJs(['fontawesome-all', 'fontawasome-icon', 'jquery-1.9.0.js', 'jquery.jfontsize-1.0']);
		$this->_view->titulo = 'Ineditto:: Sistema inteligente de Gesti�n Empresarial';
      $this->_view->renderizar('index', false, 1);
	}	
}
