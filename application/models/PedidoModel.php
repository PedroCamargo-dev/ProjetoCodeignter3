<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PedidoModel extends CI_Model
{

    public function getFunction()
    {
        $this->db->select('*');
        $this->db->from('functions');
        $this->db->where('status', '1');
        return $this->db->get()->result();
    }

    public function getAllProducts()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status', '1');
        return $this->db->get()->result();
    }

    public function getProduct($id)
    {
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("idProduct", $id);
        $this->db->where('status', '1');
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
}
