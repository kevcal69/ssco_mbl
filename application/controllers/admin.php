<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends MBL_Controller {
	    function __construct() {
	        parent::__construct();
	        $this->load->model('Module_model','mModel');

      		$this->load->helper('application_helper');
	    }	

		public function index() {
			$data['page_title'] = "SSCO Module Base Learning";
			$data['body_content'] = $this->load->view('admin/home',array(),TRUE); // kevcal
			$this->parser->parse('layouts/default', $data);
		}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */