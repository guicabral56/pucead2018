<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ClienteModel');        
        
    }	

    public function index()
    {
        
    }
	
    public function index_get($cpf = '')
    {
        $params=array();
        foreach ($_GET as $k => $v) {
            $params[$k] = $this->get($k);
        }

        if($cpf != '') $params['cpf'] = $cpf;
        
        $list = $this->ClienteModel->get($params)->result();

        if ($list) {
            $this->response($list, 200);
        } else {
            $this->response('', 400);
        }
    }

    public function index_options()
    {
        
    }

    /**
     * Atualiza/Insere Cliente
     * HTTP 1.1
     * METODO POST
     */
    public function index_post($Cpf)
    {
        //lista campos 
        $campos = $this->db->list_fields($this->ClienteModel->getTableName());
        $post = [];

        foreach ($campos as $k) {

            $field_value = $this->post($k);
            if (!empty($field_value)) {

                $post[$k] = $this->db->escape_str($field_value);

            }
        }

        if(count($post) == 0){
            $this->response(['message' => 'Faltou preencher os parametros de campo']);
        }

        $msg_out = '';
        $status = 0;       
            
        $status = 1;
        $msg_out = $this->ClienteModel->Post($Cpf, $post);        
        
        $this->response(['status' => $status, 'message' => $msg_out], 201);
        
    }
   
    /**
     * DELETE CLIENTE
     * HTTP 1.1
     * METODO DELETE
     */
    public function index_delete($cpf)
    {
        $out = $this->ClienteModel->Deletar($cpf);
        if ($out === true) {
            $this->response(['message' => 'Cliente excluído com sucesso'], 200);
        } else {
            $this->response(['message' => ''], 400);
        }

    }

}

/* End of file ClienteControler.php */
