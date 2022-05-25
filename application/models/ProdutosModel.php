<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdutosModel extends CI_Model
{

    public function getFunction()
    {
        $this->db->select('*');
        $this->db->from('functions');
        $this->db->where('status', '1');
        return $this->db->get()->result();
    }

    public function cadProdutos($data)
    {
        if (!empty($data)) {
            return $this->db->insert('products', $data);
        }
    }

    public function listProdutos($idUser)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('idUser', $idUser);
        $this->db->where('status', '1');
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function delProdutos($id)
    {
        $this->db->set('status', '0');
        $this->db->where('idProduct', $id);
        return $this->db->update('products');
    }

    public function editProduto($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('idProduct', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function updateProdutos($data)
    {
        return $this->db->update('products', $data, array('idProduct' => $data['idProduct']));
    }
}
