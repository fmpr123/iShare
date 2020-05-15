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

	public function update()
	{
		$this->Posts_model->update_post();
		redirect('');
	}

	public function delete($slug)
	{
		$this->Posts_model->delete_post($slug);
		redirect('');
	}

	public function private($slug)
	{
		$this->Posts_model->private_post($slug);
		redirect('');
	}

	public function report($slug)
	{
		$this->Posts_model->report_post($slug);
		redirect('');
	}
	public function like($slug)
	{
		$this->Posts_model->like_post($slug);
		redirect('');
	}

	public function ajax()
	{
		$view = "ajax";
		$this->load_view($view);
	}

	public function create_thumbnail($url)
	{
		$target = urlencode($url);
		$key = "8f9f867a82e13139b24bf9c7d9cb9387";
		$ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
		$result = json_decode($ret);
		$image = $result->image;
		return $image;
	}
}
