<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends MBL_Controller {
	    function __construct() {
	        parent::__construct();
	        $this->load->model('Homepage_model','mModel');

      		$this->load->helper('application_helper');
	    }	

		public function index() {
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('admin/options',array(),TRUE); // kevcal
			$this->parser->parse('layouts/home', $data);
		}

		public function module() {
			$this->load->model('Homepage_model','mModel');
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('admin/module',array('modules' => $this->mModel->get_module_entries()),TRUE); // kevcal
			$this->parser->parse('layouts/home', $data);
		}

		public function create() {
			$this->load->model('Homepage_model','mModel');
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('module/create',array(),TRUE); // kevcal
			$this->parser->parse('layouts/home', $data);
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */