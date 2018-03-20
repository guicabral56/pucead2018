<?php

defined('BASEPATH') or exit('No direct script access allowed');

class usuario extends REST_Controller
{
    private $usuario;
    private $senha;

    public function __construct() {

        parent::__construct();                
        $this->load->model('LoginModel');
    }

    public function index()
    {
        # code...
    }

    public function index_options(){
        
    }

    public function index_post()
    {
        $this->usuario = $this->post('usuario');
        $this->senha   = $this->post('senha');

        if($this->usuario == '' || $this->senha == '')  {
            $this->response([ 'status' => '0', 'mensagem' => 'Falta preencher os campos' ], 200);
        }

        if($this->post('acao') == 'entrar'){
            $Auth = $this->LoginModel->Entrar($this->usuario, $this->senha);
            $status = ($Auth === true) ? true : false;
        }        
        
        $Msg  = $Auth === true ? 'autenticado com sucesso' : 'usuario ou senha invalidos';
        $this->response([ 'status' => $status, 'mensagem' => $Msg ], 200);
    }

}