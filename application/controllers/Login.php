<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
			redirect('home');
		}

        $data['title'] = "Login - ManyMinds";

        $this->load->view('_layout/header', $data);
        $this->load->view('login');
        $this->load->view('_layout/footer');
    }

    public function auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->LoginModel->login($username, $password);
        $msg = '<div class="alert alert-danger" role="alert"> Username or password invalid! </div>';

        if ($user) {
            $this->session->set_userdata('user', $user[0]);
            redirect('home');
        } else {
            $this->session->set_flashdata("msg", $msg);
            redirect('login');
        }
    }

    public function logoff()
    {
        $this->session->unset_userdata('user');
        redirect('login');
    }
}
