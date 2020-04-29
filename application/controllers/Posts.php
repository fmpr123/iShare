<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
	//Dinamic header, view and footer loader
	public function load_view($view, $data = NULL)
	{
		$this->load->view('templates/header');
		$this->load->view($view, $data);
		$this->load->view('templates/footer');
	}

	public function index()
	{
		//Declaring wich view to load
		$view = 'Show';
		//---------------------------
		$data['posts'] = $this->Posts_model->show_posts();
		$this->load_view($view, $data);
	}

	public function create()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() === FALSE) {
			$view = 'create';
			$this->load_view($view);
		} else {
			$this->Posts_model->create_post();
			redirect('');
		}
	}

	public function edit($slug)
	{
		$data['posts'] = $this->Posts_model->get_post($slug);

		$view = 'Edit';
		$this->load_view($view, $data);
	}

	public function update(){
		$this->Posts_model->update_post();
		redirect('');
	}

	public function delete($slug){
		$this->Posts_model->delete_post($slug);
		redirect('');
	}
}
