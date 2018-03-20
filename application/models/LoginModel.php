<?php

class LoginModel extends CI_Model{

    const table = 'clientes';

    public function __construct() {
        parent::__construct();
    }

    public function Entrar($usuario, $senha)
    {
        $row = $this->db->get_where(self::table, [
            'email' => $usuario,
            'senha' => md5($senha)
        ]);

        if($row->num_rows() == 1)
            return true;
        else 
            return false;
    }

}