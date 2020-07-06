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
        $this->form_validation->set_error_delimiters(
            '<div class="container">
		<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>',
            '</div></div>'
        );

        if ($this->form_validation->run() === FALSE) {
            $view = 'auth/login';
            $this->load_view($view);
        } else {
            $result = $this->Users_model->user_verification();
            if (empty($result)) {
                $this->session->set_flashdata('login_error', 'Dados incorretos!');
                redirect('login');
            } else {
                $user = $result;
                $user_data = array(
                    'id' => $user[0]['id'],
                    'name' => $user[0]['name'],
                    'logged_in' => true,
                    'isAdmin' => $user[0]['isAdmin']
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success', 'Login feito com sucesso!');
                redirect('');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        $this->session->set_flashdata('logout', 'Logout feito com sucesso!');
        redirect('');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters(
            '<div class="container">
		<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>',
            '</div></div>'
        );

        if ($this->form_validation->run() === FALSE) {
            $view = 'auth/register';
            $this->load_view($view);
        } else {
            $result = $this->Users_model->register();
            if (empty($result)) {
                $this->session->set_flashdata('signup_error', 'Registo falhou, tente novamente!');
                redirect('register');
            } else {
                $this->session->set_flashdata('signup_success', 'Registo efetuado com sucesso!');
                redirect('login');
            }
        }
    }
}
