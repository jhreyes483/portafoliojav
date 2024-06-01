<?php

/*  *********************************************************************
*   _Descripci�n: Esta clase separa el controlador, el metodo y los argumentos
*   *********************************************************************/

class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    public $_parametros;

    public function __construct()
    {

       // $url   = $_SERVER['REQUEST_URI'];
        if (isset($_GET['url'])) {
            $url =  $_GET['url'];
            $url = explode('/', $url);
            $this->_controlador = array_shift($url);
            $this->_metodo      = array_shift($url);
            $this->_parametros  = array_shift($url);
        }

        if (!$this->_controlador) {
            $this->_controlador = DEFAULT_CONTROLLER;
        }

        if (!$this->_metodo) {
            $this->_metodo = 'index';
        }

        if (!isset($this->_argumentos)) {
            $this->_argumentos = array();
        }

        if (!isset($this->_parametros)) {
            $this->_parametros = [];
        }
    }
    //retorna el controlador
    public function getControlador()
    {
   // echo $this->_controlador;
        return $this->_controlador;
    }
    //retorna el metodo
    public function getMetodo()
    {
        return $this->_metodo;
    }

    public function getParam()
    {
        return $this->_parametros;
    }
    //aqui nos hace un arreglo de argumentos
    public function getArgs()
    {
        return $this->_argumentos;
    }
}
