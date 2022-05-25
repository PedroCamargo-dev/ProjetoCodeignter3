<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function login($username, $password)
    {
        $this->db->where('userName', $username);
        $this->db->where('password', $password);
        $this->db->where('status', '1');
        return $this->db->get("users")->result();
    }

    public function getUserById($id)
    {
        $query = $this->db->get_where('users', array('idUser' => $id));
        return $query->result();
    }
}
