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
		$data['post_rating'] = $this->Posts_model->get_ratings();
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
			$result = $this->Posts_model->create_post();
			if ($result == "tag_error") {
				$this->session->set_flashdata('repeated_tag', 'Contém tags repetidas!');
				redirect('create');
			} else {
				redirect('');
			}
		}
	}

	public function edit_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}
		if($this->check_ownership($slug) == false && !$this->session->userdata('isAdmin')){
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

		$result = $this->Posts_model->update_post();
		
		if ($result['state'] == "tag_error") {
			$this->session->set_flashdata('repeated_tag', 'Contém tags repetidas!');
			redirect('edit/' . $result['post_id']);
		} else {
			redirect('');
		}
	}

	public function delete_post($slug)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}
		if($this->check_ownership($slug) == false && !$this->session->userdata('isAdmin')){
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
		if($this->check_ownership($slug) == false && !$this->session->userdata('isAdmin')){
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

	public function check_ownership($post_id){
		$result = $this->Posts_model->check_post($post_id);
		if(empty($result)){
			return false;
		}else{
			return true;
		}
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
