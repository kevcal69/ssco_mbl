<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// $this->load->view('partials/welcome_message');
		redirect('welcome/he','192.168.78.135');
	}

	public function he() {
		$this->load->view('partials/welcome_message');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */