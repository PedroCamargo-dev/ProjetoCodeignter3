<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('LoginModel');
        $this->load->model('ProdutosModel');
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['users'] = $this->LoginModel->getUserById($this->session->userdata('user')->idUser);
        $data['functions'] = $this->ProdutosModel->getFunction();
        $data['title'] = "Produtos - ManyMinds";

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/navbar');
        $this->load->view('produto');
        $this->load->view('_layout/footer');
    }

    public function cadProduto()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('idUser', 'ID', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('value', 'Value', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'response' => 'error',
                    'message' => validation_errors()
                );
            } else {
                $ajax_data = $this->input->post();
                if ($this->ProdutosModel->cadProdutos($ajax_data)) {
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

    public function listProdutos()
    {
        if ($this->input->is_ajax_request()) {
            if ($products = $this->ProdutosModel->listProdutos($this->session->userdata('user')->idUser)) {
                $data = array(
                    'response' => 'success',
                    'products' => $products
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

    public function delProduto()
    {
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post("del_id");

            if ($this->ProdutosModel->delProdutos($del_id)) {
                $data = array(
                    'response' => 'success'
                );
            } else {
                $data = array(
                    'response' => 'error'
                );
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editProduto()
    {
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');

            if ($product = $this->ProdutosModel->editProduto($edit_id)) {
                $data = array(
                    'response' => 'success',
                    'product' => $product
                );
            } else {
                $data = array(
                    'response' => 'error',
                    'message' => 'failed to fetch record'
                );
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function updateProduto()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('editName', 'Name', 'required');
            $this->form_validation->set_rules('editValue', 'Value', 'required');
            $this->form_validation->set_rules('editAmount', 'Amount', 'required');
            $this->form_validation->set_rules('editDescription', 'Description', 'required');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'response' => 'error',
                    'message' => validation_errors()
                );
            } else {
                $data['idProduct'] = $this->input->post("idProduct");
                $data['name'] = $this->input->post("editName");
                $data['value'] = $this->input->post("editValue");
                $data['amount'] = $this->input->post("editAmount");
                $data['description'] = $this->input->post("editDescription");

                if ($this->ProdutosModel->updateProdutos($data)) {
                    $data = array(
                        'response' => 'success',
                        'message' => 'Successfully updated'
                    );
                } else {
                    $data = array(
                        'response' => 'error',
                        'message' => 'Failed to update data'
                    );
                }
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
