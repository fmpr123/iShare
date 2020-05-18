<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    //Dinamic header, view and footer loader
    public function load_view($view, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $view = 'auth/login';
            $this->load_view($view);
        } else {
            $result = $this->Users_model->user_verification();
            if (empty($result)) {
                echo 'Dados incorretos';
                redirect('login');
            } else {
                $user = $result;
                $user_data = array(
                    'id' => $user[0]['id'],
                    'name' => $user[0]['name'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                redirect('');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        redirect('login');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $view = 'auth/register';
            $this->load_view($view);
        } else {
            $result = $this->Users_model->register();
            if (empty($result)) {
                echo 'Registo falhou!';
                redirect('register');
            } else {
                echo 'Registado com sucesso!';
                redirect('');
            }
        }
    }
}
