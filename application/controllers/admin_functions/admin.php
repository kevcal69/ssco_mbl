<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

			$this->load->model('Module_model','mModel');
			$this->load->helper('application_helper');
			$this->load->helper('sidebar_helper');
			$this->sidebar_content = array(
				'quicklinks' => array(

					array(
						'content' => to_sidebar_element('fa-home','Home'),
						'href' => base_url('admin'),
						'active' => TRUE
						),
					array(
						'content' => to_sidebar_element('fa-user', 'Users'),
						'href' => base_url('admin/user'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('admin/module'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-question','Tests'),
						'href' => base_url('admin/test'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-group','Trainees'),
						'href' => base_url('admin/trainee'),
						'active' => FALSE
						)
					)
				);
			//show sidebar search
			$this->sidebar_content['actions'] = array();
			$this->sidebar_content['module_search'] = TRUE;
		}

	public function index() {
		$data['scheduled_tests'] = $this->get_scheduled_tests();
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/home',$data,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	private function get_scheduled_tests() {
		$this->load->model('question_model');

		$result = array();
		$scheduled_tests = $this->question_model->get_scheduled_tests();
		if (sizeof($scheduled_tests) > 0) {
			foreach ($scheduled_tests as $index => $test) {
				$result[$index]['test_id'] = $test->id;
				$result[$index]['module_id'] = $test->module_id;
				$result[$index]['module_title'] = $this->mModel->get_title($test->module_id);
			}
		}

		return $result;
	}
}

/* End of file admin.php */
/* Location: ./application/admin_functions/admin.php */