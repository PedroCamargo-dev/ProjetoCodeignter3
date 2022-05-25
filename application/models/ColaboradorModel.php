<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ColaboradorModel extends CI_Model
{

    public function getFunction()
    {
        $this->db->select('*');
        $this->db->from('functions');
        $this->db->where('status', '1');
        return $this->db->get()->result();
    }

    public function cadColaborador($data)
    {
        if (!empty($data)) {
            return $this->db->insert('users', $data);
        }
    }

    public function listColaborador()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('functions', 'users.idFunction = functions.idFunction');
        $this->db->where('users.status', '1');
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function delColaborador($id)
    {
        $this->db->set('status', '0');
        $this->db->where('idUser', $id);
        return $this->db->update('users');
    }

    public function editColaborador($id)
    {
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("idUser", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function updateColaborador($data)
    {
        return $this->db->update('users', $data, array('idUser' => $data['idUser']));
    }
}
