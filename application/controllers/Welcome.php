<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->check_isvalidated();
	}

	private function check_isvalidated()
	{
		if ($this->session->userdata('isLogin')) {
			redirect('dashboard');
		}
	}
	
	public function index()
	{
		$this->load->view('pages/login');
	}
}
