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
        $data['posts'] = $this->Search_model->get_search();
        $view = 'Search';
        $this->load_view($view, $data);
    }
}
