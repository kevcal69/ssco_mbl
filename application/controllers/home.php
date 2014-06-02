<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MBL_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('role') == 'admin') {
			redirect('admin');
		} else if ($this->session->userdata('role') == 'trainee') {
			redirect('trainee');
		} else if ($this->session->userdata('role') == 'content_manager') {
			redirect('content_manager');
		}


		$this->load->helper('application_helper');

	}

	public function index() {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('contents/home','',TRUE); // kevcal
		$this->parser->parse('layouts/default', $data);
	}
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */
