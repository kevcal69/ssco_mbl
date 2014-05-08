<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends MBL_Controller {
	    function __construct() {
	        parent::__construct();
	        $this->load->model('Module_model','mModel');
	        			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

      		$this->load->helper('application_helper');
	    }	

		public function index() {
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('admin/home',array(),TRUE); // kevcal
			$this->parser->parse('layouts/default', $data);
		}

		public function module() {
			$this->load->model('Module_model','mModel');
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('admin/module',array('modules' => $this->mModel->get_module_entries()),TRUE); // kevcal
			$this->parser->parse('layouts/default', $data);
		}

		public function create() {
			$this->load->model('Module_model','mModel');
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('module/create',array(),TRUE); // kevcal
			$this->parser->parse('layouts/home', $data);
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */