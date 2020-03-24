<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('Show');
		$this->load->view('templates/footer');
	}
}
