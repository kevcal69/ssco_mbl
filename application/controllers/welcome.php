<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/header'); // paul
		$this->load->view('content_homepage/content_home'); // kevcal
		$this->load->view('partials/footer'); //paul
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */