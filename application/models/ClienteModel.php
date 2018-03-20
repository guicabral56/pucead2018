<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class ClienteModel extends CI_Model
{

    const table = 'clientes';

    public function getTableName()
    {
        return self::table;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function Inserir($put)
    {        
        $put['senha'] = md5($put['senha']);
        $return = $this->db->insert(self::table, $put);

        return ($return == 1 ? true : false);
    }

    private function Atualizar($cpf, $post)
    {
        /**decide se atualiza senha */
        if(isset($post['senha'])){

            $r1 = $this->db->get_where(self::table, ['cpf' => $cpf, 'senha' => $post['senha']]);
            if($r1->num_rows() == 1) {
                unset($post['senha']);
            }
            else{
                $post['senha'] = md5($post['senha']);
            }
        
        }        
        $this->db->where('cpf', $cpf);
        $this->db->set($post);
        $out = $this->db->update(self::table);

        return ($out == 1 ? true : false);
    }

    public function Post($cpf, $post)
    {
        $row = $this->db->get_where(self::table, ['cpf' => $cpf]);
        if($row->num_rows() == 0){ 
            $this->Inserir($post);
            return 'Cliente inserido com sucesso';
        }
        else {
            $this->Atualizar($cpf, $post);
            return 'Cliente atualizado com sucesso';
        }
    }

    public function Deletar($idCliente)
    {
        $this->db->where('cpf', $idCliente);
        $out = $this->db->delete(self::table);        
        return ($out == 1 ? true : false);
    }


    function get( $params = array() )
    {   
        if(count($params) > 0){                           
            foreach ($params as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        return $this->db->get(self::table, 10, 0);
    }


}

/* End of file ClienteModel.php */
