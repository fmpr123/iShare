<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    //Dinamic header, view and footer loader
    public function load_view($view, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    public function search_post()
    {
        $choice = $this->input->post('choice');
        $search = $this->input->post('search');

        if ($choice == "0") {
            $choice = "ASC";
        }

        $data['posts'] = $this->Search_model->search_title($search, $choice);

        $view = 'Search';
        $this->load_view($view, $data);
    }
}
