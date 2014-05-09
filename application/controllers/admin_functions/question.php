<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Question extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}			
			$this->load->model('Module_model','mModule');
      			$this->load->helper('application_helper');
	    }	

	function create() {
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/question/create',array('modules' => $this->mModule->get_module_entries()),TRUE); // kevcal
		$this->parser->parse('layouts/default', $data);
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */