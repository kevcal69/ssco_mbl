<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Test extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}		
			$this->load->model('Module_model','mModule');	
			$this->load->model('Question_model','mQ');
      			$this->load->helper('application_helper');
      			$this->load->helper('sidebar_helper');
			$this->sidebar_content = array(
				'quicklinks' => array(

					array(
						'content' => to_sidebar_element('fa-home','Home'),
						'href' => base_url('admin'),
						'active' => FALSE
						),					
					array(
						'content' => to_sidebar_element('fa-user', 'Users'),
						'href' => base_url('admin/user'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('admin/module'),
						'active' => TRUE
						)
					)
				);            			
	    }	
	function index() {
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','strm');
		$this->load->model('admin/user_model','user_model');
		$this->sidebar_content['actions'] = array(
					);	
		$testDB['scheduled_test']  = $this->mQ->get_scheduled_tests();	
		$testDB['user_stats']  =  $this->user_model->view_trainee();

		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/test/test_home',$testDB,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}	   
	function module_test_view($id) {
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','mod_res');
		$myData['module_test_result'] = $this->mod_res->get_test_results_with_module_detail($id);
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/test/module_test_result',$myData,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	} 
	function result($test_result_id) {
		$this->load->model('admin/user_model');
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','test_result_model');
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_result',$result_content,TRUE);
			$data['page_title'] = "SSCO Module-Based Learning";
			$this->parser->parse('layouts/default', $data);
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
