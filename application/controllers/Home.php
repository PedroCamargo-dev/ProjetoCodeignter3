<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		if (!$this->session->userdata('user')) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['users'] = $this->LoginModel->getUserById($this->session->userdata('user')->idUser);
		$data['title'] = "Home - ManyMinds";

		$this->load->view('_layout/header', $data);
		$this->load->view('_layout/navbar', $data);
		$this->load->view('home');
		$this->load->view('_layout/footer', $data);
	}
}
