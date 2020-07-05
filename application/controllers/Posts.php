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
		$data['posts'] = $this->Posts_model->get_posts();
		$this->load_view($view, $data);
	}

	public function create_post()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('tags', 'tags', 'required');
		$this->form_validation->set_error_delimiters(
			'<div class="container">
		<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>',
			'</div></div>'
		);

		if ($this->form_validation->run() === FALSE) {
			$data['tags'] = $this->Posts_model->get_tags();
			$view = 'create';
			$this->load_view($view, $data);
		} else {
			$this->Posts_model->create_post();
			redirect('');
		}
	}

	public function edit_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$data['posts'] = $this->Posts_model->get_post($slug);
		$data['tags'] = $this->Posts_model->get_tags();
		$view = 'Edit';
		$this->load_view($view, $data);
	}

	public function update_post()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}
		
		$this->Posts_model->update_post();
		redirect('');
	}

	public function delete_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->Posts_model->delete_post($slug);
		redirect('');
	}

	public function private_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->Posts_model->private_post($slug);
		redirect('');
	}

	public function report_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->Posts_model->report_post($slug);
		redirect('');
	}
	public function like_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}

		$this->Posts_model->like_post($slug);
		redirect('');
	}

	//Testes
	public function ajax()
	{
		$string = "Livro Vídeo Java ";
		$array = explode(" ", $string);
		$data['posts'] = $this->Posts_model->get_tag_id($array[3]);
		$view = "ajax";
		$this->load_view($view, $data);
	}
}
