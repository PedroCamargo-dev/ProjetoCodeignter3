<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');

class Pedido extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('LoginModel');
        $this->load->model('PedidoModel');
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['users'] = $this->LoginModel->getUserById($this->session->userdata('user')->idUser);
        $data['functions'] = $this->PedidoModel->getFunction();
        $data['products'] = $this->PedidoModel->getAllProducts();
        $data['title'] = "Pedido - ManyMinds";

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/navbar');
        $this->load->view('pedido');
        $this->load->view('_layout/footer');
    }

    public function getAllProducts()
    {
        if ($this->input->is_ajax_request()) {
            $idProduct = $this->input->post('codigo');

            if ($product = $this->PedidoModel->getProduct($idProduct)) {
                $data = array(
                    'response' => 'success',
                    'product' => $product
                );
            } else {
                $data = array(
                    'response' => 'error',
                    'message' => 'Failed'
                );
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function cadPedido()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('idFunction', 'Function', 'required');
            $this->form_validation->set_rules('userName', 'Username', 'required');
            $this->form_validation->set_rules('firstName', 'Name', 'required');
            $this->form_validation->set_rules('lastName', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{11}$/]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'response' => 'error',
                    'message' => validation_errors()
                );
            } else {
                $ajax_data = $this->input->post();
                if ($this->ColaboradorModel->cadColaborador($ajax_data)) {
                    $data = array(
                        'response' => 'success',
                        'message' => 'Successfully recorded'
                    );
                } else {
                    $data = array(
                        'response' => 'error',
                        'message' => 'Failed'
                    );
                }
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
