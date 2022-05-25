<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('LoginModel');
        $this->load->model('ColaboradorModel');
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['users'] = $this->LoginModel->getUserById($this->session->userdata('user')->idUser);
        $data['functions'] = $this->ColaboradorModel->getFunction();
        $data['title'] = "Colaborador - ManyMinds";

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/navbar');
        $this->load->view('colaborador');
        $this->load->view('_layout/footer');
    }

    public function cadColaborador()
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

    public function listColaborador()
    {
        if ($this->input->is_ajax_request()) {
            if ($users = $this->ColaboradorModel->listColaborador()) {
                $data = array(
                    'response' => 'success',
                    'users' => $users
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

    public function delColaborador()
    {
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post("del_id");

            if ($this->ColaboradorModel->delColaborador($del_id)) {
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

    public function editColaborador()
    {
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');

            if ($user = $this->ColaboradorModel->editColaborador($edit_id)) {
                $data = array(
                    'response' => 'success',
                    'user' => $user
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

    public function updateColaborador()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('editIdFunction', 'Function', 'required');
            $this->form_validation->set_rules('editUserName', 'Username', 'required');
            $this->form_validation->set_rules('editFirstName', 'Name', 'required');
            $this->form_validation->set_rules('editLastName', 'Last Name', 'required');
            $this->form_validation->set_rules('editEmail', 'E-mail', 'required|valid_email');
            $this->form_validation->set_rules('editPhone', 'Phone', 'required|regex_match[/^[0-9]{11}$/]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'response' => 'error',
                    'message' => validation_errors()
                );
            } else {
                $data['idUser'] = $this->input->post("idUser");
                $data['idFunction'] = $this->input->post("editIdFunction");
                $data['userName'] = $this->input->post("editUserName");
                $data['firstName'] = $this->input->post("editFirstName");
                $data['lastName'] = $this->input->post("editLastName");
                $data['email'] = $this->input->post("editEmail");
                $data['phone'] = $this->input->post("editPhone");

                if ($this->ColaboradorModel->updateColaborador($data)) {
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
