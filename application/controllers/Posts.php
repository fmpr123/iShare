<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
	//Dinamic header, view and footer loader
	public function load_view($view,$data=NULL)
	{
		$this->load->view('templates/header');
		$this->load->view($view['name'],$data);
		$this->load->view('templates/footer');
	}

	public function index()
	{
		//Declaring wich view to load
		$view['name'] = 'Show';

		$this->load_view($view);
	}
}
